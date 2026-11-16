<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegisterRequest;
use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function store(StoreRegisterRequest $request)
    {
        $profile = Profile::create([
            'umur'   => 0,
            'bio'    => '',
            'alamat' => '',
        ]);

        $role = Role::where('nama', 'user')->first();

        User::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'profile_id' => $profile->id,
            'role_id'    => $role->id,
        ]);

        return redirect('/')->with('success', 'Pendaftaran berhasil!');
    }
}