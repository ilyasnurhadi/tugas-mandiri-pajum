<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Film;

class DashboardController extends Controller
{
    public function user()
    {
        // Mengambil data film untuk ditampilkan di dashboard user (Sesuai Slide 20)
        $films = Film::all(); 
        return view('dashboard.user', compact('films'));
    }
    
    public function admin()
    {
        return view('dashboard.admin');
    }
}