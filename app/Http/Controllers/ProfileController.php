<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Tampilkan halaman profil pengguna.
     */
    public function show()
    {
        return view('profile', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Perbarui data profil pengguna (Nama, Email, Foto Profil & Kata Sandi).
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048'],
            'avatar_url' => ['nullable', 'string', 'url'],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah digunakan oleh pengguna lain.',
            'avatar.image' => 'File foto profil harus berupa gambar.',
            'avatar.mimes' => 'Format foto profil harus JPG, PNG, WEBP, atau GIF.',
            'avatar.max' => 'Ukuran foto profil maksimal 2 MB.',
            'avatar_url.url' => 'Tautan URL gambar tidak valid.',
            'password.min' => 'Kata sandi minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        // Konversi foto profil file ke Base64 Data URI agar kompatibel penuh dengan Vercel Serverless & Local
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $mime = $file->getMimeType();
            $base64Data = base64_encode(file_get_contents($file->getRealPath()));
            $user->avatar = 'data:' . $mime . ';base64,' . $base64Data;
        } elseif (!empty($validated['avatar_url'])) {
            $user->avatar = $validated['avatar_url'];
        }

        // Update kata sandi jika diisi
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return back()->with('success', 'Profil Anda telah berhasil diperbarui!');
    }
}
