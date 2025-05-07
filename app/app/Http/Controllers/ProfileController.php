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


    public function show()
    {
        $user = Auth::user();

        return view('profile.index', compact('user'));
    }
    /**
     * Отображение профиля пользователя.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        $orders = Order::where('user_id', $user->id)->get();

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


        $user->name = $request->name;
        $user->email = $request->email;


        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::delete($user->avatar);
            }

            $user->avatar = $request->file('avatar')->store('avatars', 'public');
        }

        $user->save();

        return redirect()->route('profile.edit')->with('status', 'profile-updated');
    }
}
