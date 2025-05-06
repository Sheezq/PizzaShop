<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmationMail;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
            'payment_method' => 'required|string|in:card_online,cash,courier_card',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'note' => 'nullable|string|max:1000',
            'token' => 'required_if:payment_method,card_online',
        ]);

        $userId = Auth::id();
        $cart = session()->get("cart_$userId", []);

        if ($validated['payment_method'] === 'card_online') {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            try {
                Charge::create([
                    'amount' => $validated['amount'] * 100,
                    'currency' => 'usd',
                    'source' => $validated['token'],
                    'description' => 'Pizza order payment',
                ]);
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Платёж не прошёл: ' . $e->getMessage());
            }
        }

        $order = Order::create([
            'user_id' => auth()->user()?->id ?? null,
            'total_price' => $validated['amount'],
            'status' => 'в обработке',
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'note' => $validated['note'] ?? null,
            'payment_method' => $validated['payment_method'],
            'items' => $cart,
        ]);


        $this->sendOrderToTelegram($order);
        Mail::to($order->email)->send(new OrderConfirmationMail($order, $order->items));

        session()->forget('cart_' . Auth::user()->email);
        session()->save();

        return redirect()->route('payment.thankyou', [
            'name' => $order->name,
            'amount' => $order->total_price,
            'payment' => $order->payment_method,
        ]);
    }


    private function escapeMarkdown($text)
    {
        $specialChars = ['\\', '_', '*', '[', ']', '(', ')', '~', '`', '>', '#', '+', '=', '|', '{', '}', '.', '!', '@'];

        $text = str_replace('-', '\-', $text);

        foreach ($specialChars as $char) {
            $text = str_replace($char, '\\' . $char, $text);
        }

        return $text;
    }


    private function sendOrderToTelegram(Order $order)
    {
        $botToken = env('TELEGRAM_BOT_TOKEN');
        $chatId = env('TELEGRAM_CHAT_ID');

        $message = "📦 Новый заказ!\n";
        $message .= "👤 Имя: " . $order->name . "\n";
        $message .= "📧 Email: " . $order->email . "\n";
        $message .= "📱 Телефон: " . $order->phone . "\n";
        $message .= "🏠 Адрес: " . $order->address . "\n";
        $message .= "💬 Пожелания: " . ($order->note ?? '—') . "\n";
        $message .= "💳 Способ оплаты: " . $order->payment_method . "\n";
        $message .= "💵 Сумма: " . $order->total_price . " ₽\n";

        $message .= "\n🍕 Товары в заказе:\n";
        foreach ($order->items as $item) {
            $message .= "🧀 " . $item['name'] . " - " . $item['quantity'] . " шт. x " . $item['price'] . " ₽\n";
        }

        $response = Http::post("https://api.telegram.org/bot{$botToken}/sendMessage", [
            'chat_id' => $chatId,
            'text' => $message,
        ]);

        if (!$response->successful()) {
            \Log::error('Ошибка при отправке в Telegram: ' . $response->body());
            \Log::error('HTTP статус код: ' . $response->status());
        }
    }

}
