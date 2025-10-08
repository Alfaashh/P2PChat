<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SponsorMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role === 'sponsor') {
            return $next($request);
        }
        abort(403, 'AKSES INI HANYA UNTUK SPONSOR.');
    }
}