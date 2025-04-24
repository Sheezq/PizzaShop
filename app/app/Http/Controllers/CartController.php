<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pizza;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function add(Pizza $pizza)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$pizza->id])) {
            $cart[$pizza->id]['quantity']++;
        } else {
            // Гарантируем, что image_url будет относительным от public/storage
            $relativeImagePath = 'pizzas/' . basename($pizza->image_url);

            $cart[$pizza->id] = [
                "name" => $pizza->name,
                "price" => $pizza->price,
                "image_url" => 'pizzas/' . basename($pizza->getRawOriginal('image_url')),
                "quantity" => 1
            ];

        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Пицца добавлена в корзину!');
    }

    public function remove(Pizza $pizza)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$pizza->id])) {
            if ($cart[$pizza->id]['quantity'] > 1) {
                $cart[$pizza->id]['quantity']--;
            } else {
                unset($cart[$pizza->id]);
            }
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Пицца удалена из корзины!');
    }

    public function clear()
    {
        session()->forget('cart');

        return redirect()->route('cart.index')->with('success', 'Корзина очищена!');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        $total = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));

        return view('payment.checkout', [
            'total' => $total,
            'pizzas' => $cart,
        ]);
    }

}
