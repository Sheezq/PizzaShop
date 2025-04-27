<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $message = $request->input('message');

        return redirect()->route('contact')->with('success', 'Ваше сообщение отправлено!');
    }
}
