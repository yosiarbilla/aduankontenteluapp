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
        $credentials = $request->only('email', 'password');

        // Kirim request ke API eksternal
        $response = Http::post('https://instansi.aduankonten.id/api/v01/auth', $credentials);
    
        // Jika login API berhasil
        if ($response->successful()) {
            $data = $response->json();
    
            // Simpan token API di session
            session(['api_token' => $data['token']]);
    
            // Login pengguna di Laravel menggunakan database lokal tanpa password
            $user = \App\Models\User::firstOrCreate(
                ['email' => $credentials['email']],
    [
        'name' => $data['user']['name'] ?? 'Guest',
        'password' => bcrypt('default_password'), // Berikan nilai default
    ] // Hanya isi email dan name
            );
    
            auth()->login($user);
    
            $request->session()->regenerate();
    
            return redirect()->intended(RouteServiceProvider::HOME);
        }
    
        // Jika login gagal
        return back()->withErrors([
            'email' => 'Login gagal. Silakan cek kembali email dan password Anda.',
        ]);
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
