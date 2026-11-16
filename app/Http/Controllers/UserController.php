<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::join('roles', 'users.role_id', '=', 'roles.id')
            ->select('users.*', 'roles.nama as role_name')
            ->orderBy('users.id')
            ->paginate(10);

        return view('admin.users.index', compact('users'));
    }
}