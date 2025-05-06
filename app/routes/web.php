<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pizza;
use App\Models\User;

use App\Http\Controllers\{
    AuthController,
    ProfileController,
    CartController,
    PaymentController,
    MenuController,
    ContactController,
    CheckoutController,
    PageController,
    SearchController
};

use App\Http\Controllers\Admin\{
    AdminController,
    AdminUserController,
    PizzaController
};

use App\Http\Controllers\Api\OrderController;
use Laravel\Socialite\Facades\Socialite;

// ПУБЛИЧНЫЕ СТРАНИЦЫ
Route::get('/', function () {
    $pizzas = Pizza::all();
    return view('welcome', compact('pizzas'));
})->name('home');

Route::get('/menu', [MenuController::class, 'index'])->name('menu');
Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::get('/contacts', fn() => view('contacts'))->name('contacts');
Route::get('/contact', fn() => view('contact'))->name('contact');
Route::post('/contact/submit', [ContactController::class, 'submit'])->name('contact.submit');

Route::get('/info', fn() => view('info'))->name('info');
Route::get('/privacy-policy', fn() => view('privacy-policy'))->name('privacy.policy');
Route::get('/terms-of-service', fn() => view('terms-of-service'))->name('terms.of.service');

Route::get('/banned', fn() => view('banned'))->name('banned');

// АВТОРИЗАЦИЯ
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// GOOGLE
Route::get('/auth/google', fn() => Socialite::driver('google')->redirect())->name('auth.google');
Route::get('/auth/google/callback', function () {
    $googleUser = Socialite::driver('google')->user();

    $user = User::firstOrCreate(
        ['email' => $googleUser->getEmail()],
        ['name' => $googleUser->getName() ?? 'No Name', 'password' => bcrypt(Str::random(16))]
    );

    Auth::login($user);
    return redirect('/');
});

// КОРЗИНА — доступна всем
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{pizza}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove/{pizza}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// СТРАНИЦЫ ДЛЯ АВТОРИЗОВАННЫХ ПОЛЬЗОВАТЕЛЕЙ (не забаненных)
Route::middleware(['auth', 'check.banned'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/checkout', [CartController::class, 'checkout'])->name('payment.checkout');
    Route::post('/process-payment', [PaymentController::class, 'processPayment'])->name('payment.process');

    Route::get('/orders/history', [\App\Http\Controllers\OrderHistoryController::class, 'index'])->name('orders.history');
    Route::get('/credits', [\App\Http\Controllers\CreditController::class, 'index'])->name('credits.index');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');

    Route::get('/payment/thankyou', function (Request $request) {
        return view('payment.thankyou', [
            'name' => $request->query('name'),
            'amount' => $request->query('amount'),
            'payment' => $request->query('payment'),
        ]);
    })->name('payment.thankyou');
});

// АДМИНКА — только для админов
Route::middleware(['auth', 'check.banned', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('pizzas', PizzaController::class)->except(['show']);
});

Route::middleware(['auth', 'check.banned', 'role:admin'])->group(function () {
    Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::patch('/admin/users/{user}', [AdminUserController::class, 'update'])->name('admin.users.update');
});
