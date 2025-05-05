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
        ]);

        $this->sendOrderToTelegram($order);
        Mail::to($order->email)->send(new OrderConfirmationMail($order));


        return redirect()->route('payment.thankyou', [
            'name' => $order->name,
            'amount' => $order->total_price,
            'payment' => $order->payment_method,]);

    }

    private function escapeMarkdown($text)
    {
        $escape = ['\\', '_', '*', '[', ']', '(', ')', '~', '`', '>', '#', '+', '-', '=', '|', '{', '}', '.', '!', '@'];
        foreach ($escape as $char) {
            $text = str_replace($char, '\\' . $char, $text);
        }
        return $text;
    }



    private function sendOrderToTelegram(Order $order)
    {
        $botToken = env('TELEGRAM_BOT_TOKEN');
        $chatId = env('TELEGRAM_CHAT_ID');

        $message = $this->escapeMarkdown("📦 Новый заказ!");
        $message .= "👤 Имя: " . $this->escapeMarkdown($order->name) . "\n";
        $message .= "📧 Email: " . $this->escapeMarkdown($order->email) . "\n";
        $message .= "📱 Телефон: " . $this->escapeMarkdown($order->phone) . "\n";
        $message .= "🏠 Адрес: " . $this->escapeMarkdown($order->address) . "\n";
        $message .= "💬 Пожелания: " . $this->escapeMarkdown($order->note ?? '—') . "\n";
        $message .= "💳 Способ оплаты: " . $this->escapeMarkdown($order->payment_method) . "\n";
        $message .= "💵 Сумма: " . $order->total_price . " ₽\n";

        $response = Http::get("https://api.telegram.org/bot{$botToken}/sendMessage", [
            'chat_id' => $chatId,
            'text' => $message,
            'parse_mode' => 'MarkdownV2',
        ]);

        if (!$response->successful()) {
            \Log::error('Ошибка при отправке в Telegram: ' . $response->body());
        }

    }

}
