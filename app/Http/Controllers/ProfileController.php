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
            'alamat'  => 'required|string',
        ]);

        $user = Auth::user();

        // Update tabel users
        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        // Update profil lewat relasi users.profile_id (buat baru bila belum ada)
        $data = [
            'umur'   => $request->umur,
            'bio'    => $request->bio ?? '',
            'alamat' => $request->alamat,
        ];

        if ($user->profile) {
            $user->profile->update($data);
        } else {
            $profile = \App\Models\Profile::create($data);
            $user->update(['profile_id' => $profile->id]);
        }

        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui!');
    }
}