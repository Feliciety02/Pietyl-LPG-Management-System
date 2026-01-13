<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

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
    $t0 = microtime(true);

    $request->authenticate();
    Log::info('login.authenticate ms', ['ms' => (microtime(true)-$t0)*1000]);

    $t1 = microtime(true);
    $request->session()->regenerate();
    Log::info('login.session.regenerate ms', ['ms' => (microtime(true)-$t1)*1000]);

    $t2 = microtime(true);
    $user = $request->user();
    Log::info('login.getUser ms', ['ms' => (microtime(true)-$t2)*1000]);

    $t3 = microtime(true);
    $hasAdmin = $user->hasRole('Owner Admin');
    Log::info('login.hasRole ms', ['ms' => (microtime(true)-$t3)*1000]);

    if (! $user->is_active) {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return back()->withErrors([
            'email' => 'Account is inactive. Please contact admin.',
        ]);
    }

    return $hasAdmin
        ? redirect()->route('admin.dashboard')
        : redirect()->route('dashboard');
}

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
