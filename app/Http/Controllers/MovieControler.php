<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MovieControler extends Controller
{
    function index()
    {
        $movies = \App\Models\Movie::all();
        return view('movies', ['movies' => $movies]);
    }

    function show()
    {
        $movies = \App\Models\Movie::all();
        return response()->json($movies);
    }
}

