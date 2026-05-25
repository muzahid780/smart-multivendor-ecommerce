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
     * Show login page
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle login request
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // authenticate user
        $request->authenticate();

        // security session regenerate
        $request->session()->regenerate();

        $user = $request->user();

        // ================= ROLE BASED REDIRECT =================

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'vendor') {
            return redirect()->route('vendor.dashboard');
        }

        // default customer redirect
        return redirect()->route('home');
    }

    /**
     * Logout user
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}