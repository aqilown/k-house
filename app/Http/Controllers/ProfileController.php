<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Update informasi profil
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'no_telepon' => 'nullable|string|max:20',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'pekerjaan' => 'nullable|string|max:100'
        ], [
            'nama.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah digunakan'
        ]);

        $user->update($request->only([
            'nama', 'email', 'no_telepon', 'tanggal_lahir', 
            'alamat', 'jenis_kelamin', 'pekerjaan'
        ]));

        return redirect()->route('profile')->with('success', 'Profil berhasil diupdate!');
    }

    /**
     * Update password
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed'
        ], [
            'current_password.required' => 'Password lama harus diisi',
            'password.required' => 'Password baru harus diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok'
        ]);

        $user = Auth::user();

        // Cek password lama
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->route('profile')->with('error', 'Password lama tidak sesuai!');
        }

        // Update password
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('profile')->with('success', 'Password berhasil diubah!');
    }
}