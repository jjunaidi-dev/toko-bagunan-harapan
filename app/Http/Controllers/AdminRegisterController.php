<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminRegisterController extends Controller
{
    public function create()
    {
        return view('admin.register');
    }

    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'email'    => 'required|email|unique:admins,email',
            'password' => 'required|min:6',
        ], [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'email.unique'      => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min'      => 'Password minimal 6 karakter.',
        ]);

        // Simpan ke tabel admins menggunakan Model Admin
        Admin::create([
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/')->with('success_register', 'Akun admin berhasil dibuat! Silakan login.');
    }
}