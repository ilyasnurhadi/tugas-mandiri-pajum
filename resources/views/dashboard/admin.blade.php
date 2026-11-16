@extends('templates.index')

@section('content')
<div class="container" style="padding: 40px 0;">
    <h2>Dashboard Administrator</h2>
    <p class="text-muted">Selamat datang, Administrator! Anda memiliki hak akses penuh untuk mengelola data sistem.</p>
    
    <hr style="margin: 20px 0;">

    <!-- Menu / Tombol Navigasi CRUD untuk Admin (Sesuai Slide 20) -->
    <div class="row" style="margin-bottom: 30px;">
        <div class="col-md-12">
            <h3>Menu Pengelolaan Data</h3>
            <div style="display: flex; gap: 10px; flex-wrap: wrap; margin-top: 15px;">
                <a href="{{ route('admin.films.index') }}" class="btn btn-primary" style="padding: 10px 20px; background: #ff9800; color: white; text-decoration: none; border-radius: 4px;">Kelola Film</a>
                <a href="{{ route('admin.casts.index') }}" class="btn btn-info" style="padding: 10px 20px; background: #00bcd4; color: white; text-decoration: none; border-radius: 4px;">Kelola Cast</a>
                <a href="{{ route('admin.genres.index') }}" class="btn btn-success" style="padding: 10px 20px; background: #4caf50; color: white; text-decoration: none; border-radius: 4px;">Kelola Genre</a>
                <a href="{{ route('admin.perans.index') }}" class="btn btn-secondary" style="padding: 10px 20px; background: #607d8b; color: white; text-decoration: none; border-radius: 4px;">Kelola Peran</a>
                <a href="{{ route('admin.users.index') }}" class="btn btn-dark" style="padding: 10px 20px; background: #3f51b5; color: white; text-decoration: none; border-radius: 4px;">Lihat List Data User</a>
            </div>
        </div>
    </div>

</div>
@endsection