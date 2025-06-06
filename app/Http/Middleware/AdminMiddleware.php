<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->name == 'admin') {
            return $next($request); // jika admin, lanjutkan request
        }

        return redirect()->route('home'); // jika bukan admin, redirect ke halaman utama
    }
}
