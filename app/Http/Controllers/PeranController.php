<?php

namespace App\Http\Controllers;

use App\Models\Cast;
use App\Models\Film;
use App\Models\Peran;
use App\Http\Requests\StorePeranRequest;
use App\Http\Requests\UpdatePeranRequest;

class PeranController extends Controller
{
    public function index()
    {
        $perans = Peran::join('films', 'perans.film_id', '=', 'films.id')
            ->join('casts', 'perans.cast_id', '=', 'casts.id')
            ->select('perans.*', 'films.title as film_title', 'casts.name as cast_name')
            ->orderBy('perans.id', 'desc')
            ->paginate(10);

        return view('admin.perans.index', compact('perans'));
    }

    public function create()
    {
        return view('admin.perans.form', [
            'peran' => new Peran(),
            'films' => Film::orderBy('title')->get(),
            'casts' => Cast::orderBy('name')->get(),
        ]);
    }

    public function store(StorePeranRequest $request)
    {
        Peran::create($request->validated());

        return redirect()->route('admin.perans.index');
    }

    public function show(Peran $peran)
    {
        //
    }

    public function edit(Peran $peran)
    {
        return view('admin.perans.form', [
            'peran' => $peran,
            'films' => Film::orderBy('title')->get(),
            'casts' => Cast::orderBy('name')->get(),
        ]);
    }

    public function update(UpdatePeranRequest $request, Peran $peran)
    {
        $peran->update($request->validated());

        return redirect()->route('admin.perans.index');
    }

    public function destroy(Peran $peran)
    {
        $peran->delete();

        return redirect()->route('admin.perans.index');
    }
}