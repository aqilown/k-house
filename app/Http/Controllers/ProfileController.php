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
            'pekerjaan' => 'nullable|string|max:100',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ], [
            'nama.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'foto_profil.image' => 'File harus berupa gambar',
            'foto_profil.mimes' => 'Format gambar: jpeg, png, jpg',
            'foto_profil.max' => 'Ukuran gambar maksimal 2MB'
        ]);

        $data = $request->only([
            'nama', 'email', 'no_telepon', 'tanggal_lahir', 
            'alamat', 'jenis_kelamin', 'pekerjaan'
        ]);

        // Handle upload foto profil
        if ($request->hasFile('foto_profil')) {
            // Delete old photo if exists
            if ($user->foto_profil && $user->foto_profil !== 'default-avatar.png') {
                if (file_exists(public_path($user->foto_profil))) {
                    unlink(public_path($user->foto_profil));
                }
            }

            // Upload new photo
            $file = $request->file('foto_profil');
            $filename = 'profile_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/profiles'), $filename);
            $data['foto_profil'] = 'uploads/profiles/' . $filename;
        }

        $user->update($data);

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