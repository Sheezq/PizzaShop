<?php

use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
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

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::patch('/admin/users/{user}', [AdminUserController::class, 'update'])->name('admin.users.update');
});

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{pizza}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove/{pizza}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');


use App\Http\Controllers\SearchController;

Route::get('/search', [SearchController::class, 'search'])->name('search');

