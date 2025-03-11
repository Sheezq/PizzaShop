<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pizza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Сохранение изображения
        $imagePath = $request->file('image')->store('pizzas', 'public');

        $pizza = Pizza::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image_url' => '/storage/' . $imagePath,
        ]);

        return response()->json($pizza, 201);
    }

    public function destroy($id)
    {
        $pizza = Pizza::find($id);

        if (!$pizza) {
            return response()->json(['message' => 'Пицца не найдена'], 404);
        }

        // Удаление файла изображения
        if ($pizza->image_url) {
            $imagePath = str_replace('/storage/', '', $pizza->image_url);
            Storage::disk('public')->delete($imagePath);
        }

        $pizza->delete();

        return response()->json(['message' => 'Пицца удалена'], 200);
    }
}
