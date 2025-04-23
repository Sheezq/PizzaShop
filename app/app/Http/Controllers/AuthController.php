<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    // Регистрация пользователя
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'role' => 'in:user,admin',
        ]);

        // Проверяем, имеет ли текущий пользователь право назначать админа
        if ($request->role === 'admin' && (!Auth::check() || !Auth::user()->hasRole('admin'))) {
            return response()->json(['message' => 'У вас нет прав для назначения роли админа'], 403);
        }

        // Создаем пользователя
        $user = User::create([
            'name' => trim($request->name),
            'email' => trim($request->email),
            'password' => Hash::make($request->password),
        ]);

        // Назначаем роль через Spatie
        $user->assignRole($request->role ?? 'user');

        // Создаем токен
        $token = $user->createToken('API Token')->plainTextToken;

        return response()->json([
            'message' => 'Вы успешно зарегистрировались!',
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    // Логин пользователя
    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Проверяем, существует ли пользователь с данным email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'Неверные учетные данные.'], 401);
        }

        // Если пользователь заблокирован, сразу отклоняем вход
        if ($user->banned) {
            return response()->json(['message' => 'Ваш аккаунт заблокирован. Обратитесь к администратору.'], 403);
        }

        // Пробуем выполнить аутентификацию
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Неверные учетные данные.'], 401);
        }

        // Генерация токена для авторизованного пользователя
        $token = $user->createToken('API Token')->plainTextToken;

        return response()->json([
            'message' => 'Вы успешно вошли в систему!',
            'user' => $user,
            'token' => $token,
        ]);
    }

    // Выход из системы
    public function logout(Request $request)
    {
        // Проверяем, авторизован ли пользователь
        if (Auth::check()) {
            Auth::user()->tokens()->delete(); // Удаляем все токены пользователя
            Auth::logout();  // Разлогиниваем пользователя
            return response()->json(['message' => 'Вы успешно вышли из системы!']);
        }

        return response()->json(['message' => 'Вы не авторизованы!'], 401);
    }
}
