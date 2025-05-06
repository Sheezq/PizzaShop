<?php

namespace App\Models;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class Cart
{

    public static function getUserCartKey()
    {
        return 'cart_' . Auth::id();
    }

    public static function add($product)
    {
        $cart = Session::get(self::getUserCartKey(), []);
        $cart[] = $product;
        Session::put(self::getUserCartKey(), $cart);
    }


    public static function getTotalCount()
    {
        $cart = Session::get(self::getUserCartKey(), []);
        return count($cart);
    }


    public static function getAll()
    {
        return Session::get(self::getUserCartKey(), []);
    }

    public static function remove($index)
    {
        $cart = Session::get(self::getUserCartKey(), []);
        if (isset($cart[$index])) {
            unset($cart[$index]);
            Session::put(self::getUserCartKey(), array_values($cart));
        }
    }

    public static function clear()
    {
        Session::forget(self::getUserCartKey());
    }
}
