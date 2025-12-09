<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Tampilkan form login admin
     */
    public function showAdminLogin()
    {
        // Jika sudah login, redirect ke dashboard
        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        
        return view('auth.admin-login');
    }

    /**
     * Proses login admin
     */
    public function adminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 6 karakter'
        ]);

        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Cek apakah user ada dan role adalah admin
        if (!$user || $user->role !== 'admin') {
            return back()->with('error', 'Email atau password salah! Pastikan Anda login sebagai admin.');
        }

        // Cek password
        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Email atau password salah!');
        }

        // Login user
        Auth::login($user, $request->filled('remember'));

        // Redirect ke admin dashboard
        return redirect()->route('admin.dashboard')->with('success', 'Selamat datang, Admin!');
    }

    /**
     * Logout admin
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Berhasil logout!');
    }

    /**
     * Tampilkan form login user (untuk nanti)
     */
    public function showUserLogin()
    {
        if (Auth::check() && Auth::user()->role === 'user') {
            return redirect()->route('profile');
        }
        
        return view('auth.login');
    }

    /**
     * Proses login user (untuk nanti)
     */
    public function userLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $user = Auth::user();
            
            // Pastikan yang login adalah user biasa
            if ($user->role === 'user') {
                return redirect()->route('home')->with('success', 'Selamat datang!');
            }
            
            // Jika admin, logout dan redirect
            Auth::logout();
            return back()->with('error', 'Akun admin tidak bisa login di sini.');
        }

        return back()->with('error', 'Email atau password salah!');
    }
}