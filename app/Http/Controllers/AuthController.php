<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validasi input (memastikan format email benar)
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        
        // Cek login menggunakan sistem bawaan Laravel
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Jika yang login adalah email admin, arahkan ke menu admin
            if (Auth::user()->email === 'admin@jlpt.com') {
                return redirect()->route('admin');
            }

            // Jika user biasa, arahkan ke beranda
            return redirect()->route('beranda');
        }

        // Jika login gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('beranda');
    }
}