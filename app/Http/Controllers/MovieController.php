<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MovieRulesRequest;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
        return view('movies/movies', ['movies' => $movies]);
    }

    function register(Request $request)
    {
        return view('movies/register');
    }

    // function rules(MovieRulesRequest $request)
    // {
    //     $validate_rule = [
    //         'title' => 'required|max:20|unique:movies',
    //         'image_url' => 'required|url',
    //         'description' => 'required|max:100',
    //         'published_year' => 'required|integer',
    //         'created_at' => 'required|date',
    //         'is_showing' => 'required',
    //     ];
    //     $this->validate($request, $validate_rule);
    // }
    public function create(MovieRulesRequest $request) {
        $created_at = Carbon::now();
        $updated_at = Carbon::now();
        $is_showing = $request->is_showing ? 1 : 0;
        $param = [
            'title' => $request->title,
            'image_url' => $request->image_url,
            'description' => $request->description,
            'published_year' => $request->published_year,
            'created_at' => $created_at->format('Y-m-d 0:0:0'),
            'updated_at' => $updated_at->format('Y-m-d H:i:s'),
            'is_showing' => $is_showing,
        ];
        DB::table('movies')->insert($param);
        return redirect('/admin/movies');
    }
}


