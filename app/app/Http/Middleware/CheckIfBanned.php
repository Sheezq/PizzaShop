<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckIfBanned
{
    public function handle(Request $request, Closure $next)
    {
        // Если пользователь залогинен и он заблокирован
        if (Auth::check() && Auth::user()->banned) {
            // Перенаправляем на страницу с ошибкой или на специальную страницу
            return redirect()->route('banned'); // Создаем эту страницу ниже
        }

        return $next($request);
    }
}

