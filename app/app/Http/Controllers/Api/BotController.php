<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BotController extends Controller
{
    public function webhook(Request $request)
    {
        $botToken = '7603115928:AAEbm2N3HvhtH6GNWOcrSBjD4xhvCPZR_XA';

        // Получаем данные от Telegram
        $data = $request->all();

        if (isset($data['callback_query'])) {
            $callback = $data['callback_query'];
            $callbackData = $callback['data']; // ready_10|+79001234567

            [$command, $phone] = explode('|', $callbackData); // Разделяем строку

            $minutes = (int)str_replace('ready_', '', $command);

            // Отвечаем на callback чтобы убрать "часики" в Telegram
            Http::post("https://api.telegram.org/bot{$botToken}/answerCallbackQuery", [
                'callback_query_id' => $callback['id'],
                'text' => "Отправляем СМС клиенту!",
                'show_alert' => false,
            ]);

            // Отправляем СМС клиенту
            $this->sendSms($phone, $minutes);
        }

        return response('OK', 200);
    }

    private function sendSms($phone, $minutes)
    {
        // ТУТ отправляем SMS

        logger("Отправляем SMS на {$phone}: Пицца будет готова через {$minutes} минут!");

    }
}
