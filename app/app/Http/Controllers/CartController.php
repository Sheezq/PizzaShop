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
            $cart[$pizza->id] = [
                "name" => $pizza->name,
                "price" => $pizza->price,
                "image_url" => $pizza->image_url,
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
}
