<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\PizzaController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Admin\AdminController;
use App\Models\Pizza;

// Главная страница с отображением списка пицц
Route::get('/', function () {
    $pizzas = Pizza::all();
    return view('welcome', compact('pizzas'));
})->name('home');

// Страница оформления заказа
Route::get('/order', [OrderController::class, 'index'])->name('order');

// Регистрация
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Логин
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Выход
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Профиль пользователя (только для авторизованных)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Дашборд для обычных пользователей
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

// Админ-панель
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // Управление пиццами в админке
    Route::resource('pizzas', PizzaController::class)->except(['show']);
});
