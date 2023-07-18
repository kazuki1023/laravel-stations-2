<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Movie;

class MovieController extends Controller
{
    function index()
    {
        $movies = Movie::all();
        return view('movies', ['movies' => $movies]);
    }

    function show()
    {
        $movies = Movie::all();
        return view('movies/movies', ['movies' => $movies]);
    }

    function register(Request $request)
    {
        return view('movies/register');
    }

    public function store(Request $request)
    {
        // バリデーション作成
        $rules = [
            'title' => 'required|max:255|unique:movies',
            'image_url' => 'required|url',
            'published_year' => 'required|integer',
            'description' => 'required|max:255',
            'is_showing' => 'required',
        ];
        $messages = [
            'title.required' => 'タイトルを入力してください',
            'title.max' => 'タイトルは255文字以内で入力してください',
            'title.unique' => 'タイトルは既に登録されています',
            'image_url.required' => '画像URLを入力してください',
            'image_url.url' => '画像URLを正しく入力してください',
            'published_year.required' => '公開年を入力してください',
            'description.max' => '概要は255文字以内で入力してください',
            'description.required' => '概要を入力してください',
            'is_showing.max' => '公開年を入力してください',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            // バリデーションエラーが発生した場合の処理
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $created_at = Carbon::now();
        $is_showing = ($request->is_showing == '上映中') ? true : false;
        // dd($is_showing);
        $movie = new Movie();
        $movie->title = $request->title;
        $movie->image_url = $request->image_url;
        $movie->description = $request->description;
        $movie->published_year = $request->published_year;
        $movie->created_at = $created_at->format('Y-m-d H:i:s');
        $movie->updated_at = $created_at->format('Y-m-d H:i:s');
        $movie->is_showing = $is_showing;
        $movie->save();
        // dd($movie);
        return redirect('/admin/movies');
    }
}
