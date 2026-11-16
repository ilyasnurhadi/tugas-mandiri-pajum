<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user()->load('profile');
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'umur'    => 'required|integer',
            'bio'     => 'nullable|string',
            'alamat'  => 'required|string', // Ubah dari address ke alamat
        ]);

        $user = Auth::user();

        // Update tabel users
        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        // Update atau buat tabel profiles
        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'umur'   => $request->umur,
                'bio'    => $request->bio,
                'alamat' => $request->alamat, // Ubah dari address ke alamat
            ]
        );

        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui!');
    }
}