<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // authenticate user
        $request->authenticate();

        // regenerate session (security)
        $request->session()->regenerate();

        // get logged in user
        $user = $request->user();

        // 🔥 role-based redirect
        if ($user->role === 'admin') {
            return redirect('/admin/dashboard');
        }

        if ($user->role === 'vendor') {
            return redirect('/vendor/dashboard');
        }

        // default: customer or others
        return redirect('/dashboard');
    }

    /**
     * Logout user
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}