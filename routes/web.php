<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CastController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\PeranController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KritikController;

Route::get('/', [FilmController::class, 'movieHome'])->name('home');
Route::get('/movies', [FilmController::class, 'movies'])->name('movies');
Route::get('/movies/{film}', [FilmController::class, 'show'])->name('movies.show');
Route::get('/movies/genre/{genre}', [FilmController::class, 'moviesByGenre'])->name('genre');

// Route Register & Login
Route::get('/register', [RegisterController::class, 'create'])->name('register.create');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::get('/login', [AuthController::class, 'login'])->name('login.login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('login.logout');

// Group Route yang butuh Login & Authorization (Gate)
Route::middleware(['auth'])->group(function () {

    // Khusus User Biasa
    Route::middleware(['can:user'])->group(function () {
        Route::get('/dashboard/user', [DashboardController::class, 'user'])->name('dashboard.user');
        Route::post('/komentar', [KritikController::class, 'store'])->name('komentar.store');
    });

    // Khusus Admin
    Route::middleware(['can:admin'])->group(function () {
        Route::get('/dashboard/admin', [DashboardController::class, 'admin'])->name('dashboard.admin');

        Route::prefix('admin')->name('admin.')->group(function () {
            Route::resource('casts', CastController::class)->except('show');
            Route::resource('films', FilmController::class)->except('show');
            Route::resource('genres', GenreController::class)->except('show');
            Route::resource('perans', PeranController::class)->except('show');
            Route::get('users', [UserController::class, 'index'])->name('users.index');
        });
    });

    // Profile (user biasa melihat & mengubah profil sendiri)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});