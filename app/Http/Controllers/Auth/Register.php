<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Register extends Controller
{
    /**
     * Handle the incoming registration request.
     */
    public function __invoke(Request $request)
    {
        // 1. Validasi input dari form
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // 2. Membuat user baru dan enkripsi password (Hash)
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // 3. Otomatis login setelah berhasil daftar
        Auth::login($user);

        // 4. Kembali ke halaman utama dengan pesan sukses
        return redirect('/')->with('success', 'Account created! Welcome to Chirper.');
    }
}