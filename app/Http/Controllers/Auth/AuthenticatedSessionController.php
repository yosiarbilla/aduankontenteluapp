<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');

        // First, try local database authentication
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        // If local auth fails, try API authentication
        try {
            $response = Http::post('https://instansi.aduankonten.id/api/v01/auth', $credentials);

            if ($response->successful()) {
                $data = $response->json();
                session(['api_token' => $data['token']]);

                // Create or update local user
                $user = \App\Models\User::firstOrCreate(
                    ['email' => $credentials['email']],
                    [
                        'name' => $data['user']['name'] ?? 'Guest',
                        'password' => bcrypt($credentials['password']),
                    ]
                );

                auth()->login($user);
                $request->session()->regenerate();

                return redirect()->intended(RouteServiceProvider::HOME);
            }
        } catch (\Exception $e) {
            // Log the error if needed
            // \Log::error('API Authentication error: ' . $e->getMessage());
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
