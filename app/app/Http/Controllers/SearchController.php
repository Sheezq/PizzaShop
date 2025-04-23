<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query'); // Строка поиска

        // Если есть строка запроса, выполняем поиск, иначе получаем все пиццы
        $pizzas = Pizza::where('name', 'like', '%' . $query . '%')
            ->orWhere('description', 'like', '%' . $query . '%')
            ->get();

        // Передаем пиццы в представление
        return view('welcome', compact('pizzas'));
    }
}
