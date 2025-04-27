<?php

namespace App\Http\Controllers;

use App\Models\Pizza;

class MenuController extends Controller
{
    public function index()
    {
        $pizzas = Pizza::all();
        return view('menu', compact('pizzas'));
    }
}
