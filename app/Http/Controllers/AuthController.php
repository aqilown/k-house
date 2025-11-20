<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email_user' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email_user', $request->email_user)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user, $request->filled('remember'));

            if ($user->isPemilik()) {
                return redirect()->route('pemilik.dashboard');
            }
            return redirect()->route('user.dashboard');
        }

        return back()->withErrors(['email_user' => 'Email atau password salah']);
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email_user' => 'required|email|unique:users,email_user',
            'password' => 'required|min:6|confirmed',
            'role_user' => 'required|in:pemilik,pencari',
            'nomor_handphone' => 'nullable|string|max:20',
        ]);

        $user = User::create([
            'nama' => $request->nama,
            'email_user' => $request->email_user,
            'password' => Hash::make($request->password),
            'role_user' => $request->role_user,
            'nomor_handphone' => $request->nomor_handphone,
        ]);

        Auth::login($user);

        if ($user->isPemilik()) {
            return redirect()->route('pemilik.dashboard');
        }
        return redirect()->route('user.dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}