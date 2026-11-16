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
    
    // Dashboard User (Khusus User Biasa)
    Route::get('/dashboard/user', [DashboardController::class, 'user'])
        ->name('dashboard.user')
        ->middleware('can:user');

    // Dashboard Admin & CRUD Manajemen (Khusus Admin)
    Route::middleware(['can:admin'])->group(function () {
        Route::get('/dashboard/admin', [DashboardController::class, 'admin'])->name('dashboard.admin');
        
        // Resource Routes untuk CRUD (Film, Cast, Genre, Peran)
        Route::resource('film', FilmController::class);
        Route::resource('cast', CastController::class);
        Route::resource('genre', GenreController::class);
        Route::resource('peran', PeranController::class);

        // List Data User
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
    });

    // Profile Route (Bisa diakses user biasa untuk melihat & mengubah profil sendiri)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});