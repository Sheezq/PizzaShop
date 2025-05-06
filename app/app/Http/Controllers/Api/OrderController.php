<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return response()->json($orders);
    }

    public function store(Request $request)
    {
        $request->validate([
            'total_price' => 'required|numeric|min:1',
            'status' => 'nullable|string',
        ]);

        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $request->total_price,
            'items' => session('cart'),
            'status' => $request->status ?? 'в обработке',
        ]);

        //отправляем заказ в Телеграм
        $this->sendOrderToTelegram($order);

        return response()->json($order, 201);
    }

    public function show($id)
    {
        $order = Order::find($id);

        if (!$order || $order->user_id !== Auth::id()) {
            return response()->json(['message' => 'Заказ не найден или у вас нет доступа'], 404);
        }

        return response()->json($order);
    }

    /**
     * Отправка информации о заказе в Telegram
     */
    private function sendOrderToTelegram(Order $order)
    {
        $botToken = '7603115928:AAEbm2N3HvhtH6GNWOcrSBjD4xhvCPZR_XA';
        $chatId = '335649816';

        $user = Auth::user();

        $message = "📦 *Новый заказ!*\n\n";
        $message .= "👤 Имя: {$user->name}\n";
        $message .= "📱 Телефон: {$user->phone}\n";
        $message .= "💵 Сумма: {$order->total_price} ₽\n\n";
        $message .= "Выберите время готовности:";

        $keyboard = [
            'inline_keyboard' => [
                [
                    ['text' => '10 мин', 'callback_data' => "ready_10|{$user->phone}"],
                    ['text' => '20 мин', 'callback_data' => "ready_20|{$user->phone}"],
                    ['text' => '30 мин', 'callback_data' => "ready_30|{$user->phone}"],
                ],
                [
                    ['text' => '45 мин', 'callback_data' => "ready_45|{$user->phone}"],
                    ['text' => '60 мин', 'callback_data' => "ready_60|{$user->phone}"],
                ],
            ],
        ];

        file_get_contents("https://api.telegram.org/bot{$botToken}/sendMessage?" . http_build_query([
                'chat_id' => $chatId,
                'text' => $message,
                'parse_mode' => 'Markdown',
                'reply_markup' => json_encode($keyboard),
            ]));
    }
}
