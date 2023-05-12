<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MovieRulesRequest;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Movie;

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
        try {
            DB::getRawPdo();
            echo "データベースに接続されました！";
        } catch (\Exception $e) {
            echo ("データベースに接続できませんでした。エラー: " . $e->getMessage());
        }
        $created_at = Carbon::now();
        $is_showing = $request->is_showing ? 1 : 0;
        $movie = new Movie();
        $movie->title = $request->title;
        $movie->image_url = $request->image_url;
        $movie->description = $request->description;
        $movie->published_year = $request->published_year;
        $movie->created_at = $created_at->format('Y-m-d H:i:s');
        $movie->updated_at = $created_at->format('Y-m-d H:i:s');
        $movie->is_showing = $is_showing;
        $movie->save();
        dd($movie);
        return redirect('/admin/movies');
    }
}


