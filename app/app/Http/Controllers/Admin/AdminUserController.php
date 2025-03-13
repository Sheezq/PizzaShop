<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function update(Request $request, User $user)
    {
        $user->banned = !$user->banned;
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Статус пользователя обновлен!');
    }
}
