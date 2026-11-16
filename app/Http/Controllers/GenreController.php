<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::paginate(10);

        return view('admin.genres.index', compact('genres'));
    }

    public function create()
    {
        return view('admin.genres.form', ['genre' => new Genre()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate(['name' => 'required|string|max:255']);

        Genre::create($data);

        return redirect()->route('admin.genres.index')->with('success', 'Genre berhasil ditambahkan!');
    }

    public function edit(Genre $genre)
    {
        return view('admin.genres.form', compact('genre'));
    }

    public function update(Request $request, Genre $genre)
    {
        $data = $request->validate(['name' => 'required|string|max:255']);

        $genre->update($data);

        return redirect()->route('admin.genres.index')->with('success', 'Genre berhasil diperbarui!');
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();

        return redirect()->route('admin.genres.index')->with('success', 'Genre berhasil dihapus!');
    }
}