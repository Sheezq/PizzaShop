<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pizza;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $cart = session()->get("cart_$userId", []);

        return view('cart.index', compact('cart'));
    }


    public function add(Pizza $pizza)
    {

        $userId = Auth::id();

        $cart = session()->get("cart_$userId", []);

        if (isset($cart[$pizza->id])) {
            $cart[$pizza->id]['quantity']++;
        } else {
            $cart[$pizza->id] = [
                'name' => $pizza->name,
                'price' => $pizza->price,
                'image_url' => 'pizzas/' . basename($pizza->getRawOriginal('image_url')),
                'quantity' => 1,
            ];
        }

        session()->put("cart_$userId", $cart);

        return redirect()->back()->with('success', 'Пицца добавлена в корзину!');
    }


    public function remove(Pizza $pizza)
    {
        $userId = Auth::id();

        $cart = session()->get("cart_$userId", []);

        if (isset($cart[$pizza->id])) {
            if ($cart[$pizza->id]['quantity'] > 1) {
                $cart[$pizza->id]['quantity']--;
            } else {
                unset($cart[$pizza->id]);
            }

            session()->put("cart_$userId", $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Пицца удалена из корзины!');
    }

    public function clear()
    {
        $userId = Auth::id();

        session()->forget("cart_$userId");

        return redirect()->route('cart.index')->with('success', 'Корзина очищена!');
    }

    public function checkout()
    {
        $userId = Auth::id();

        $cart = session()->get("cart_$userId", []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Ваша корзина пуста!');
        }

        $total = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));

        return view('payment.checkout', [
            'total' => $total,
            'pizzas' => $cart,
        ]);
    }
}
