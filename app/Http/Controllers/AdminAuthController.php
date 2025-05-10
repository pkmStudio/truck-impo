<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($credentials)) {
            return back()->withErrors(['error' => 'Неверные данные']);
        }

        $user = Auth::user();

        // Проверяем, является ли пользователь админом
        if (!$user->is_admin) {
            Auth::logout();
            return back()->withErrors(['error' => 'Доступ только для админов']);
        }

        return redirect()->route('admin.index');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
