<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'role' => 'in:user,admin',
        ]);

        if ($request->role === 'admin' && (!Auth::check() || !Auth::user()->hasRole('admin'))) {
            return response()->json(['message' => 'У вас нет прав для назначения роли админа'], 403);
        }

        $user = User::create([
            'name' => trim($request->name),
            'email' => trim($request->email),
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->role ?? 'user');

        Auth::login($user);

        return redirect()->route('home');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['email' => 'Неверные учетные данные.'])->withInput();
        }

        if ($user->banned) {
            Auth::logout();
            return redirect()->route('banned');
        }

        Auth::login($user);

        return redirect()->intended(route('home'));
    }

    public function logout(Request $request)
    {
        if (Auth::check()) {
            Auth::user()->tokens()->delete();
            Auth::logout();
        }

        return redirect()->route('home');
    }
}
