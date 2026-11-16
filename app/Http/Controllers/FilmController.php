<?php

namespace App\Http\Controllers;

use App\Models\{
    Film,
    Genre,
    Kritik,
    Peran,
};
use App\Http\Requests\StoreFilmRequest;
use App\Http\Requests\UpdateFilmRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{
    /* =====================================================
     |  BAGIAN PUBLIK (halaman utama) - TIDAK DIUBAH
     ===================================================== */

    public function movies()
    {
        //
        $genreFilm = null;
        $films = Film::select('id','title', 'poster','year')
                ->when(request('q'), fn ($query, $q) => $query->where('title', 'like', "%{$q}%"))
                ->orderByDesc('year')
                ->OrderBy('created_at', 'asc')
                ->paginate(18)
                ->withQueryString();
        return view('components/movies', compact('films', 'genreFilm'));
    }

    public function show(Film $film)
    {
        //
        $filmByGenre    = Film::select('id','title', 'poster','year', 'sinopsis')
                        ->where('genre_id', '=', $film->genre_id)
                        ->OrderBy('created_at', 'asc')
                        ->limit(7)
                        ->get();
        $filmByRelease  = Film::select('id','title', 'poster','year')
                        ->where('year', '=', Carbon::now()->format('Y'))
                        ->OrderBy('created_at', 'asc')
                        ->limit(9)
                        ->get();

        // Komentar terbaru dulu, lengkap dengan nama penulisnya
        $comments       = Kritik::select('kritiks.comment', 'kritiks.rating', 'users.name as user_name')
                        ->join('users', 'users.id', '=', 'kritiks.user_id')
                        ->where('kritiks.film_id', '=', $film->id)
                        ->orderByDesc('kritiks.created_at')
                        ->orderByDesc('kritiks.id')
                        ->limit(10)
                        ->get();

        // Daftar peran, lengkap dengan nama cast
        $perans         = Peran::select('perans.actor', 'casts.name as cast_name')
                        ->join('casts', 'casts.id', '=', 'perans.cast_id')
                        ->where('perans.film_id', '=', $film->id)
                        ->get();

        return view('components.movie-show', compact('film','filmByGenre','filmByRelease','comments', 'perans'));
    }

    public function movieHome()
    {
        $films = Film::select('id','title', 'poster','year')
                ->OrderBy('created_at', 'asc')
                ->limit(9)->get();
        $filmFutured = Film::select('id','title', 'poster','year')
                        ->orderByDesc('year')
                        ->OrderBy('created_at', 'asc')
                        ->limit(6)->get();
        $filmRecentAdded = Film::select('id','title', 'poster','year')
                            ->orderByDesc('created_at', 'asc')
                            ->limit(6)->get();
        $filmSlidey = Film::select('title', 'poster','sinopsis')
                        ->orderByDesc('year')
                        ->OrderBy('created_at', 'asc')
                        ->limit(6)->get();
        return view('components/home', compact('filmSlidey','films','filmFutured','filmRecentAdded'));
    }

    public function moviesByGenre($genre)
    {
        //
        $genreFilm = Genre::where('id', '=', $genre)->first();
        $films = Film::select('id','title', 'poster','year')
                ->where('genre_id', '=', $genre)
                ->orderByDesc('year')
                ->OrderBy('created_at', 'asc')
                ->paginate(18);
        return view('components/movies', compact('films','genreFilm'));
    }

    /* =====================================================
     |  BAGIAN ADMIN (CRUD) - BARU
     ===================================================== */

    public function index()
    {
        $films = Film::join('genres', 'films.genre_id', '=', 'genres.id')
            ->select('films.*', 'genres.name as genre_name')
            ->orderByDesc('films.id')
            ->paginate(10);

        return view('admin.films.index', compact('films'));
    }

    public function create()
    {
        return view('admin.films.form', [
            'film'   => new Film(),
            'genres' => Genre::orderBy('name')->get(),
        ]);
    }

    public function store(StoreFilmRequest $request)
    {
        $data = $request->validated();
        $data['poster'] = $this->storePoster($request->file('poster'));

        Film::create($data);

        return redirect()->route('admin.films.index');
    }

    public function edit(Film $film)
    {
        return view('admin.films.form', [
            'film'   => $film,
            'genres' => Genre::orderBy('name')->get(),
        ]);
    }

    public function update(UpdateFilmRequest $request, Film $film)
    {
        $data = $request->validated();

        if ($request->hasFile('poster')) {
            $this->deletePoster($film->poster);
            $data['poster'] = $this->storePoster($request->file('poster'));
        } else {
            unset($data['poster']);
        }

        $film->update($data);

        return redirect()->route('admin.films.index');
    }

    public function destroy(Film $film)
    {
        // peran dan kritik film ini dihapus dulu (kunci asing tidak cascade)
        Peran::where('film_id', $film->id)->delete();
        Kritik::where('film_id', $film->id)->delete();

        $this->deletePoster($film->poster);
        $film->delete();

        return redirect()->route('admin.films.index');
    }

    /* ---------- fungsi bantu poster ---------- */

    private function storePoster($file): string
    {
        // disimpan di storage/app/public/posters, diakses lewat /storage/posters/...
        return 'storage/' . $file->store('posters', 'public');
    }

    private function deletePoster(?string $poster): void
    {
        // hanya hapus file yang dibuat lewat form ini, poster bawaan seeder dibiarkan
        if ($poster && str_starts_with($poster, 'storage/posters/')) {
            Storage::disk('public')->delete(substr($poster, strlen('storage/')));
        }
    }
}