<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetugasAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('petugas')->check()) {
            return redirect()->route('petugas.login');
        }
        return $next($request);
    }
}
