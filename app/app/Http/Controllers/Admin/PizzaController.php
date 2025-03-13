<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pizza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PizzaController extends Controller
{
    public function index()
    {
        $pizzas = Pizza::all();
        return view('admin.pizzas.index', compact('pizzas'));
    }

    public function create()
    {
        return view('admin.pizzas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric|min:0',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imagePath = $request->hasFile('image')
            ? $request->file('image')->store('pizzas', 'public')
            : null;

        Pizza::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image_url' => $imagePath,
        ]);

        return redirect()->route('admin.pizzas.index')->with('success', 'Пицца добавлена!');
    }

    public function edit(Pizza $pizza)
    {
        return view('admin.pizzas.edit', compact('pizza'));
    }

    public function update(Request $request, Pizza $pizza)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric|min:0',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {

            if ($pizza->image_url) {
                $oldImagePath = 'public/' . $pizza->image_url;
                if (Storage::exists($oldImagePath)) {
                    Storage::delete($oldImagePath);
                }
            }

            $pizza->image_url = $request->file('image')->store('pizzas', 'public');
        }

        $pizza->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return redirect()->route('admin.pizzas.index')->with('success', 'Пицца обновлена!');
    }

    public function destroy(Pizza $pizza)
    {
        if ($pizza->image_url) {
            $oldImagePath = 'public/' . $pizza->image_url;
            if (Storage::exists($oldImagePath)) {
                Storage::delete($oldImagePath);
            }
        }

        $pizza->delete();

        return redirect()->route('admin.pizzas.index')->with('success', 'Пицца удалена!');
    }
}
