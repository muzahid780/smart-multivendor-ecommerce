<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VendorMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $user = auth()->user();
        if (!$user) {
            abort(403, 'Unauthorized access');
        }
        $role = strtolower(trim($user->role ?? ''));
        $allowedRoles = ['vendor', 'admin'];
        if (!in_array($role, $allowedRoles)) {
            abort(403, 'Access denied: Vendor only area');
        }
        if ($role === 'vendor') {
            return $next($request);
        }
        if ($role === 'admin') {
            return $next($request);
        }
        abort(403, 'Access denied');
    }
}