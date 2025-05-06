<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pizza;
use App\Models\Type; // Подключаем модель Type для работы с типами пицц
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PizzaController extends Controller
{
    // Метод отображения всех пицц
    public function index()
    {
        $pizzas = Pizza::with('type')->get();
        return view('admin.pizzas.index', compact('pizzas'));
    }


    // Метод для отображения формы добавления пиццы
    public function create()
    {
        // Получаем все типы пицц из базы данных
        $types = Type::all();
        return view('admin.pizzas.create', compact('types')); // Передаем типы в представление
    }

    // Метод для сохранения новой пиццы
    public function store(Request $request)
    {
        \Log::info('Store request data:', $request->all());
        // Валидируем входные данные
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric|min:0',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'type_id' => 'required|exists:types,id', // Валидируем, что type_id существует в таблице types
        ]);

        // Сохраняем изображение пиццы, если оно есть
        $imagePath = $request->hasFile('image')
            ? $request->file('image')->store('pizzas', 'public')
            : null;

        // Создаем пиццу и сохраняем в базу данных

        Pizza::create([

            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image_url' => $imagePath,
            'type_id' => $request->type_id, // Сохраняем выбранный тип пиццы
        ]);

        return redirect()->route('admin.pizzas.index')->with('success', 'Пицца добавлена!');
    }

    // Метод для отображения формы редактирования пиццы
    public function edit(Pizza $pizza)
    {
        // Получаем все типы пицц
        $types = Type::all();
        return view('admin.pizzas.edit', compact('pizza', 'types')); // Передаем пиццу и типы в представление
    }

    // Метод для обновления пиццы
    public function update(Request $request, Pizza $pizza)
    {
        // Валидируем входные данные
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric|min:0',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'type_id' => 'required|exists:types,id', // Валидируем, что type_id существует в таблице types
        ]);

        // Если есть новое изображение, заменяем старое
        if ($request->hasFile('image')) {
            if ($pizza->image_url) {
                $oldImagePath = 'public/' . $pizza->image_url;
                if (Storage::exists($oldImagePath)) {
                    Storage::delete($oldImagePath); // Удаляем старое изображение
                }
            }

            // Загружаем новое изображение
            $pizza->image_url = $request->file('image')->store('pizzas', 'public');
        }

        // Обновляем данные пиццы
        $pizza->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'type_id' => $request->type_id, // Обновляем тип пиццы
        ]);

        return redirect()->route('admin.pizzas.index')->with('success', 'Пицца обновлена!');
    }

    // Метод для удаления пиццы
    public function destroy(Pizza $pizza)
    {
        // Удаляем изображение, если оно существует
        if ($pizza->image_url) {
            $oldImagePath = 'public/' . $pizza->image_url;
            if (Storage::exists($oldImagePath)) {
                Storage::delete($oldImagePath); // Удаляем изображение
            }
        }

        // Удаляем пиццу из базы данных
        $pizza->delete();

        return redirect()->route('admin.pizzas.index')->with('success', 'Пицца удалена!');
    }
}
