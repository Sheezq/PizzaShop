<?php

namespace App\Http\Middleware;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param  ...$guards
     * @return mixed
     * @throws AuthenticationException
     */
    public function handle($request, \Closure $next, ...$guards): mixed
    {
        $this->authenticate($request, $guards);

        $user = Auth::user();

        if ($user && $user->banned) {
            Auth::logout();
            return response()->json(['message' => 'Ваш аккаунт заблокирован.'], 403);  // Возвращаем ошибку
        }

        return $next($request);  // Если не заблокирован, продолжаем выполнение запроса
    }
}
