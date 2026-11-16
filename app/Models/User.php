<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    // HAPUS baris: use HasRoles; (karena bikin error trait tidak ditemukan)
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'profile_id',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    // TAMBAHKAN FUNGSI INI di sini supaya method hasRole() di header.blade.php bisa jalan:
    public function hasRole($roleName)
    {
        // Mengecek apakah user punya relasi role dan namanya sama dengan yang diminta
        return $this->role && $this->role->name === $roleName;
    }
}