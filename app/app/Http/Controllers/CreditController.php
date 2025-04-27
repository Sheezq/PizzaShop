<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreditController extends Controller
{
    public function index()
    {
        return view('credits.index');
    }
}
