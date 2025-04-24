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
            'status' => $request->status ?? 'в обработке',
        ]);

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
}
