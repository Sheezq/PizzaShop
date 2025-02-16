<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pizza;
use Illuminate\Http\Request;

class PizzaController extends Controller
{
    public function index()
    {
        $pizzas = Pizza::all();

        return response()->json($pizzas, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric|min:0',
        ]);

        $pizza = Pizza::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return response()->json($pizza, 201);
    }

    // Удаление пиццы
    public function destroy($id)
    {
        $pizza = Pizza::find($id);

        if (!$pizza) {
            return response()->json(['message' => 'Пицца не найдена'], 404);
        }

        $pizza->delete();

        return response()->json(['message' => 'Пицца удалена'], 200);
    }
}


