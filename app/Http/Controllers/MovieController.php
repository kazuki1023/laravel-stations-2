<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MovieController extends Controller
{
    function index()
    {
        $movies = \App\Models\Movie::all();
        return view('movies', ['movies' => $movies]);
    }

    function show()
    {
        $movies = \App\Models\Movie::all();
        return view('movies', ['movies' => $movies]);
    }

    function register()
    {
        return view('movies/register');
    }
}

