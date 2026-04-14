<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class Login extends Controller
{
    public function __invoke(Request $request)
    {
        // 1. Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        // 2. Coba Login dengan fitur "Remember Me"
        // $request->boolean('remember') akan bernilai true jika checkbox dicentang
        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        // 3. Amankan session (mencegah session fixation)
        $request->session()->regenerate();

        return redirect('/')->with('success', 'Welcome back!');
    }
}