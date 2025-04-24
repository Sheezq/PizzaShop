<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Отображение профиля пользователя.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        $orders = Order::where('user_id', $user->id)->get(); // Получаем заказы пользователя

        return view('profile.edit', [
            'user' => $user,
            'orders' => $orders,
        ]);
    }

    /**
     * Обновление профиля пользователя.
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Обновляем данные пользователя
        $user->name = $request->name;
        $user->email = $request->email;

        // Если пользователь загрузил новый аватар
        if ($request->hasFile('avatar')) {
            // Удаляем старый аватар (если есть)
            if ($user->avatar) {
                Storage::delete($user->avatar);
            }

            // Сохраняем новый аватар
            $user->avatar = $request->file('avatar')->store('avatars', 'public'); // Убедитесь, что используется диск 'public'
        }

        $user->save();

        return redirect()->route('profile.edit')->with('status', 'profile-updated');
    }
}
