<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
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

        $token = $user->createToken('API Token')->plainTextToken;

        return response()->json([
            'message' => 'Вы успешно зарегистрировались!',
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Неверные учетные данные.'], 401);
        }

        if ($user->banned) {
            Auth::logout();
            return redirect()->route('banned');
        }

        Auth::login($user);

        $token = $user->createToken('API Token')->plainTextToken;

        return response()->json([
            'message' => 'Вы успешно вошли в систему!',
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        if (Auth::check()) {
            Auth::user()->tokens()->delete();
            Auth::logout();
            return response()->json(['message' => 'Вы успешно вышли из системы!']);
        }

        return response()->json(['message' => 'Вы не авторизованы!'], 401);
    }
}
