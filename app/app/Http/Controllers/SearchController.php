<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $types = $request->input('type', []);
        $sort = $request->input('sort');

        $pizzas = Pizza::query();

        if ($query) {
            $pizzas->where(function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%')
                    ->orWhere('description', 'like', '%' . $query . '%');
            });
        }

        if (!empty($types)) {
            $pizzas->whereIn('type', $types);
        }

        if ($sort === 'price_asc') {
            $pizzas->orderBy('price', 'asc');
        } elseif ($sort === 'price_desc') {
            $pizzas->orderBy('price', 'desc');
        }

        $pizzas = $pizzas->get();

        return view('menu', compact('pizzas'));
    }
}
