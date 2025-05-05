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
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PageController;

Route::middleware('auth')->group(function () {
Route::get('/', function () {
    $pizzas = Pizza::all();
    return view('welcome', compact('pizzas'));
})->name('home');
});
Route::get('/order', [OrderController::class, 'index'])->name('order');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

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

Route::get('/banned', function () {
    return view('banned');
})->name('banned');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::get('/checkout', [CartController::class, 'checkout'])->name('payment.checkout');
Route::post('/process-payment', [PaymentController::class, 'processPayment'])->name('payment.process');

Route::get('/orders/history', [\App\Http\Controllers\OrderHistoryController::class, 'index'])->name('orders.history');

Route::get('/credits', [\App\Http\Controllers\CreditController::class, 'index'])->name('credits.index');

Route::get('/menu', [MenuController::class, 'index'])->name('menu');

Route::get('/info', function () {
    return view('info');
})->name('info');

Route::get('/contacts', function () {
    return view('contacts');
})->name('contacts');

Route::post('/contact/submit', [ContactController::class, 'submit'])->name('contact.submit');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');


Route::get('/menu', [\App\Http\Controllers\SearchController::class, 'search'])->name('menu');

Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');

Route::get('/payment/thankyou', function (Request $request) {
    return view('payment.thankyou', [
        'name' => $request->query('name'),
        'amount' => $request->query('amount'),
        'payment' => $request->query('payment'),
    ]);
})->name('payment.thankyou');

Route::get('/auth/google', function () {
    return Socialite::driver('google')->redirect();
})->name('auth.google');

Route::get('/auth/google/callback', function () {
    $googleUser = Socialite::driver('google')->user();

    $user = User::firstOrCreate(
        ['email' => $googleUser->getEmail()],
        ['name' => $googleUser->getName() ?? 'No Name', 'password' => bcrypt(Str::random(16))]
    );

    Auth::login($user);
    return redirect('/');
});

Route::get('/privacy-policy', function () {
    return view('privacy-policy');
})->name('privacy.policy');

Route::get('/terms-of-service', function () {
    return view('terms-of-service');
})->name('terms.of.service');

Route::get('/{page}', [PageController::class, 'static'])->whereIn('page', ['terms', 'privacy']);

