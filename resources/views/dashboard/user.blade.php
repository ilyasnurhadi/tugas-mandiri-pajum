@extends('templates.index')

@section('content')
<div class="container" style="padding: 40px 0;">
    <div style="background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
        <h2 style="font-weight: bold; color: #222; margin-bottom: 10px;">Dashboard User</h2>
        <p class="text-muted" style="font-size: 15px; margin-bottom: 25px;">Selamat datang! Nikmati berbagai koleksi film terbaru, berikan ulasan, dan kelola profil akun Anda dengan mudah.</p>
        
        <hr style="border-top: 1px solid #eee; margin-bottom: 30px;">

        <!-- Menu Akses Cepat dengan Desain Kartu / Tombol Senada -->
        <div class="row">
            <div class="col-md-4" style="margin-bottom: 20px;">
                <div style="background: #f9f9f9; border-left: 4px solid #ff9800; padding: 20px; border-radius: 4px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                    <h4 style="font-weight: bold; color: #333; margin-top: 0;">Beranda Film</h4>
                    <p style="color: #666; font-size: 13px; margin-bottom: 15px;">Jelajahi halaman utama dan temukan film-film rekomendasi populer.</p>
                    <a href="{{ route('home') }}" class="btn" style="background: #ff9800; color: white; padding: 8px 15px; border-radius: 4px; text-decoration: none; font-weight: bold;">Buka Beranda</a>
                </div>
            </div>

            <div class="col-md-4" style="margin-bottom: 20px;">
                <div style="background: #f9f9f9; border-left: 4px solid #ff9800; padding: 20px; border-radius: 4px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                    <h4 style="font-weight: bold; color: #333; margin-top: 0;">Daftar Film</h4>
                    <p style="color: #666; font-size: 13px; margin-bottom: 15px;">Lihat seluruh arsip katalog film lengkap beserta detail pemainnya.</p>
                    <a href="{{ route('movies') }}" class="btn" style="background: #ff9800; color: white; padding: 8px 15px; border-radius: 4px; text-decoration: none; font-weight: bold;">Lihat Movies</a>
                </div>
            </div>

            <div class="col-md-4" style="margin-bottom: 20px;">
                <div style="background: #f9f9f9; border-left: 4px solid #ff9800; padding: 20px; border-radius: 4px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                    <h4 style="font-weight: bold; color: #333; margin-top: 0;">Profil Saya</h4>
                    <p style="color: #666; font-size: 13px; margin-bottom: 15px;">Perbarui informasi akun, nama, atau kata sandi profil Anda.</p>
                    <a href="{{ route('profile.edit') }}" class="btn" style="background: #ff9800; color: white; padding: 8px 15px; border-radius: 4px; text-decoration: none; font-weight: bold;">Edit Profil</a>
                </div>
            </div>
        </div>

        <hr style="border-top: 1px solid #eee; margin: 10px 0 30px;">
        <h3 style="font-weight: bold; color: #222; margin-bottom: 20px;">Daftar Film</h3>
        <div class="row">
            @forelse ($films as $film)
                <div class="col-md-2 col-sm-3 col-xs-6" style="margin-bottom: 20px; text-align: center;">
                    <a href="{{ route('movies.show', $film->id) }}">
                        <img src="/{{ $film->poster }}" alt="{{ $film->title }}" style="width: 100%; height: 220px; object-fit: cover; border-radius: 4px;">
                    </a>
                    <p style="margin-top: 8px; font-weight: bold; color: #333; font-size: 13px;">{{ $film->title }}</p>
                    <small class="text-muted">{{ $film->year }}</small>
                </div>
            @empty
                <div class="col-md-12"><p class="text-muted">Belum ada film.</p></div>
            @endforelse
        </div>
    </div>
</div>
@endsection