<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ], [
            'email.required'    => 'Alamat email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        // Autentikasi menggunakan guard admin
        if (Auth::guard('admin')->attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            return response()->json([
                'success'  => true,
                'message'  => 'Login Berhasil! Mengalihkan ke dashboard...',
                'redirect' => route('barang.index')
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Email atau kata sandi yang Anda masukkan salah.'
        ], 422);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success_logout', 'Anda telah berhasil keluar.');
    }
}