<?php

namespace App\Models;

use Illuminate\Support\Facades\Session;

class Cart
{
    public static function add($product)
    {
        $cart = Session::get('cart', []);
        $cart[] = $product;
        Session::put('cart', $cart);
    }

    public static function getTotalCount()
    {
        $cart = Session::get('cart', []);
        return count($cart);
    }

    public static function getAll()
    {
        return Session::get('cart', []);
    }

    public static function remove($index)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$index])) {
            unset($cart[$index]);
            Session::put('cart', array_values($cart));
        }
    }

    public static function clear()
    {
        Session::forget('cart');
    }
}
