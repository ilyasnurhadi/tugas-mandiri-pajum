@extends('templates.index')

@section('content')
<div class="container" style="padding: 40px 0;">
    <div style="max-width: 500px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.08);">
        <h2 style="font-weight: bold; color: #222; margin-bottom: 20px;">Register</h2>

        <form action="{{ route('register.store') }}" method="POST">
            @csrf
            <div class="form-group" style="margin-bottom: 15px;">
                <label>Nama</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="form-group" style="margin-bottom: 15px;">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="form-group" style="margin-bottom: 15px;">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="form-group" style="margin-bottom: 20px;">
                <label>Ulangi Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            <button type="submit" class="btn" style="background: #ff9800; color: white; padding: 10px 25px; font-weight: bold; border: none; border-radius: 4px;">Register</button>
        </form>
    </div>
</div>
@endsection