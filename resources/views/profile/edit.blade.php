@extends('templates.index')

@section('content')
<div class="container" style="padding: 40px 0;">
    <div style="max-width: 650px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.08);">
        <h2 style="font-weight: bold; color: #222; margin-bottom: 5px;">Profil Saya</h2>
        <p class="text-muted" style="margin-bottom: 20px;">Kelola informasi data diri dan akun Anda di bawah ini.</p>

        @if(session('success'))
            <div class="alert alert-success" style="margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        <hr style="border-top: 1px solid #eee; margin-bottom: 25px;">

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group" style="margin-bottom: 18px;">
                <label style="font-weight: bold; color: #333;">Nama Lengkap</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group" style="margin-bottom: 18px;">
                <label style="font-weight: bold; color: #333;">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group" style="margin-bottom: 18px;">
                <label style="font-weight: bold; color: #333;">Umur</label>
                <input type="number" name="umur" class="form-control" value="{{ old('umur', optional($user->profile)->umur) }}" required>
                @error('umur')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group" style="margin-bottom: 18px;">
                <label style="font-weight: bold; color: #333;">Bio / Tentang Saya</label>
                <textarea name="bio" class="form-control" rows="3">{{ old('bio', optional($user->profile)->bio) }}</textarea>
                @error('bio')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group" style="margin-bottom: 25px;">
                <label style="font-weight: bold; color: #333;">Alamat</label>
                {{-- Menggunakan name="alamat" sesuai kolom database --}}
                <textarea name="alamat" class="form-control" rows="2" required>{{ old('alamat', optional($user->profile)->alamat) }}</textarea>
                @error('alamat')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center;">
                <a href="{{ route('home') }}" class="btn btn-default" style="padding: 10px 20px;">Kembali ke Beranda</a>
                <button type="submit" class="btn" style="background: #ff9800; color: white; padding: 10px 25px; font-weight: bold; border: none; border-radius: 4px;">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection