<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request); // Lanjut jika admin
        }

        return redirect()->route('home')->with('error', 'Unauthorized');
    }
}
