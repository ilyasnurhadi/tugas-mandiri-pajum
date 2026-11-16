<?php

namespace App\Http\Controllers;

use App\Models\Cast;
use App\Http\Requests\StoreCastRequest;
use App\Http\Requests\UpdateCastRequest;

class CastController extends Controller
{
    public function index()
    {
        $casts = Cast::latest()->paginate(10);

        return view('admin.casts.index', compact('casts'));
    }

    public function create()
    {
        return view('admin.casts.form', ['cast' => new Cast()]);
    }

    public function store(StoreCastRequest $request)
    {
        Cast::create($request->validated());

        return redirect()->route('admin.casts.index');
    }

    public function show(Cast $cast)
    {
        //
    }

    public function edit(Cast $cast)
    {
        return view('admin.casts.form', compact('cast'));
    }

    public function update(UpdateCastRequest $request, Cast $cast)
    {
        $cast->update($request->validated());

        return redirect()->route('admin.casts.index');
    }

    public function destroy(Cast $cast)
    {
        $cast->delete();

        return redirect()->route('admin.casts.index');
    }
}