<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use App\Models\Type;

class MenuController extends Controller
{
    public function index()
    {
        $query = Pizza::query();

        $types = Type::all();

        if (request()->has('type') && !empty(request()->type)) {
            $query->whereIn('type_id', Type::whereIn('name', request()->type)->pluck('id'));
        }

        if (request()->has('price_min') && request()->has('price_max')) {
            $query->whereBetween('price', [request()->get('price_min'), request()->get('price_max')]);
        }

        if (request()->has('sort')) {
            if (request('sort') == 'price_asc') {
                $query->orderBy('price', 'asc');
            } elseif (request('sort') == 'price_desc') {
                $query->orderBy('price', 'desc');
            }
        }

        if (request()->has('query') && !empty(request('query'))) {
            $query->where('name', 'like', '%' . request('query') . '%');
        }

        $pizzas = $query->get();

        return view('menu', compact('pizzas', 'types'));
    }
}
