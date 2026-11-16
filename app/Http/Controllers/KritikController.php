<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKritikRequest;
use App\Models\Kritik;
use Illuminate\Support\Facades\Auth;

class KritikController extends Controller
{
    public function store(StoreKritikRequest $request)
    {
        Kritik::create([
            'film_id' => $request->film_id,
            'user_id' => Auth::id(),
            'comment' => $request->comment,
            'rating'  => $request->rating,
        ]);

        return back()->with('success', 'Komentar berhasil dikirim!');
    }
}