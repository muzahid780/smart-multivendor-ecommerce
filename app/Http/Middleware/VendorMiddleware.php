<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VendorMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // 1. user login check
        if (!auth()->check()) {
            abort(403, 'Unauthorized');
        }

        // 2. get role safely
        $role = auth()->user()->role ?? null;

        // 3. normalize role (case-insensitive safe)
        if (strtolower($role) !== 'vendor') {
            abort(403, 'Access denied: Vendor only area');
        }

        return $next($request);
    }
}