<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    protected $tmdbToken;
    public function __construct(){ $this->tmdbToken = config('services.tmdb.token'); }

    public function index()
    {
        $popularMovies = $this->fetchFromTmdb('movie/popular')['results'];
        $nowPlayingMovies = $this->fetchFromTmdb('movie/now_playing')['results'];
        $genresArray = $this->fetchFromTmdb('genre/movie/list')['genres'];

        $genres = collect($genresArray)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });

        return view('index', [
            'popularMovies' => $popularMovies,
            'nowPlayingMovies' => $nowPlayingMovies,
            'genres' => $genres,
        ]);
    }

    public function show($id)
    {
        $movie = $this->fetchFromTmdb("movie/{$id}?append_to_response=credits,videos,images");

        return view('show', [
            'movie' => $movie,
        ]);
    }

    private function fetchFromTmdb(string $endpoint)
    {
        return Http::withToken($this->tmdbToken)
            ->get("https://api.themoviedb.org/3/{$endpoint}")
            ->json();
    }
}
