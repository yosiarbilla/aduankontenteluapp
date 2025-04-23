<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function show(Request $request): View
    {
        return view('profile.show', [
            'user' => $request->user(),
        ]);
    }
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $request->user()->id],
            'pangkat' => ['nullable', 'string', 'max:50'],
            'phone' => ['nullable', 'string', 'max:20'],
            'foto' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        // Handle password update if needed
        if ($request->input('password_update') === 'true') {
            $request->validate([
                'current_password' => ['required', 'current_password'],
                'password' => ['required', 'min:8', 'confirmed'],
            ]);
        }
        
        $user = $request->user();

        // Isi data user
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->pangkat = $validated['pangkat'];
        $user->phone = $validated['phone'];
        
        // Update password if requested
        if ($request->input('password_update') === 'true') {
            $user->password = Hash::make($request->input('password'));
            $passwordUpdated = true;
        } else {
            $passwordUpdated = false;
        }

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($user->foto && Storage::exists('public/profile/' . $user->foto)) {
                Storage::delete('public/profile/' . $user->foto);
            }

            // Pastikan direktori ada
            if (!Storage::exists('public/profile')) {
                Storage::makeDirectory('public/profile');
            }

            // Simpan foto baru
            $fotoName = time() . '.' . $request->foto->extension();
            $request->foto->storeAs('public/profile', $fotoName);
            $user->foto = $fotoName;
        }

        // Perbarui tanggal verifikasi email jika email berubah
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        if ($passwordUpdated) {
            // Return with password updated status
            return Redirect::route('profile.show')->with([
                'success' => 'Profil dan password berhasil diperbarui',
                'status' => 'password-updated'
            ]);
        }

        return Redirect::route('profile.show')->with('success', 'Profil berhasil diperbarui');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
