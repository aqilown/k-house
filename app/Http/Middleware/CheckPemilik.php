<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPemilik
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || !auth()->user()->isPemilik()) {
            abort(403, 'Unauthorized - Hanya pemilik yang bisa akses halaman ini');
        }

        return $next($request);
    }
}