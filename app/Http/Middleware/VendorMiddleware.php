<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VendorMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // =========================
        // 1. AUTH CHECK
        // =========================
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        if (!$user) {
            abort(403, 'Unauthorized access');
        }

        // =========================
        // 2. SAFE ROLE NORMALIZATION
        // =========================
        $role = strtolower(trim($user->role ?? ''));

        // =========================
        // 3. ROLE CHECK LOGIC
        // =========================

        // allowed roles (future scalable)
        $allowedRoles = ['vendor', 'admin'];

        if (!in_array($role, $allowedRoles)) {
            abort(403, 'Access denied: Vendor only area');
        }

        // =========================
        // 4. PERMISSION RULES
        // =========================

        // vendor allowed
        if ($role === 'vendor') {
            return $next($request);
        }

        // admin also allowed (optional bypass)
        if ($role === 'admin') {
            return $next($request);
        }

        // fallback
        abort(403, 'Access denied');
    }
}