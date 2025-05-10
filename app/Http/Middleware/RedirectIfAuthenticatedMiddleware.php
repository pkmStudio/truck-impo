<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticatedMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Если пользователь уже залогинен, отправляем его в админку
        if (Auth::check()) {
            return redirect()->route('admin.index');
        }

        return $next($request);
    }
}

