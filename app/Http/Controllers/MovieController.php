<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Genre;
use Illuminate\Pagination\LengthAwarePaginator;


use Carbon\Carbon;
use App\Models\Movie;

use function PHPUnit\Framework\isNull;

class MovieController extends Controller
{
    function index()
    {
        $movies = Movie::all();
        return view('movies', ['movies' => $movies]);
    }

    function show(Request $request)
    {
        // クエリーパラメータがある場合
        if (!empty($request->input())) {
            $keyword = $request->input('keyword');
            $is_showing =  $request->input('is_showing');
            // dd($is_showing);
            $query = Movie::query();
            if (isset($is_showing) && $is_showing !== 2) {
                $query->where('is_showing', $is_showing);
            }
            if (!is_null($keyword)) {
                $query->where(function ($query) use ($keyword) {
                    $query->where('title', 'like', '%' . $keyword . '%')
                        ->orWhere('description', 'like', '%' . $keyword . '%');
                });
            }
            $movies = $query->paginate(20)->appends(request()->query());
            return view('movies', ['movies' => $movies]);
        } else {
            $movies = Movie::paginate(20);
            return view('movies', ['movies' => $movies]);
        }
    }

    function showAdmin(Request $request)
    {
        $movies = Movie::paginate(20);
        return view('movies/movies', ['movies' => $movies]);
    }

    function register(Request $request)
    {
        return view('movies/register');
    }

    public function store(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                // バリデーション作成
                $rules = [
                    'title' => 'required|unique:movies',
                    'image_url' => 'required|url',
                    'published_year' => 'required|integer',
                    'description' => 'required|max:255',
                    'is_showing' => 'required',
                    'genre' => 'required'
                ];
                $messages = [
                    'title.required' => 'タイトルを入力してください',
                    'title.unique' => 'タイトルは既に登録されています',
                    'image_url.required' => '画像URLを入力してください',
                    'image_url.url' => '画像URLを正しく入力してください',
                    'published_year.required' => '公開年を入力してください',
                    'description.max' => '概要は255文字以内で入力してください',
                    'description.required' => '概要を入力してください',
                    'is_showing.max' => '公開年を入力してください',
                    'genre.required' => 'ジャンルを入力してください'
                ];
                $validator = Validator::make($request->all(), $rules, $messages);
                if ($validator->fails()) {
                    // バリデーションエラーが発生した場合の処理
                    return redirect()->back()->withErrors($validator)->withInput();
                    // abort(500, "Validation error");
                }
                $created_at = Carbon::now();
                $is_showing = ($request->is_showing == '上映中') ? true : false;
                $genreName = $request->input('genre');
                $genre = Genre::firstOrCreate(['name' => $genreName]);
                $movie = new Movie();
                $movie->title = $request->title;
                $movie->image_url = $request->image_url;
                $movie->description = $request->description;
                $movie->published_year = $request->published_year;
                $movie->created_at = $created_at->format('Y-m-d H:i:s');
                $movie->updated_at = $created_at->format('Y-m-d H:i:s');
                $movie->is_showing = $is_showing;
                $movie->genre()->associate($genre);
                $movie->save();
            });
        } catch (\Exception $e) {
            return abort(500, "Validation error");
        }
        return redirect('/admin/movies');
    }

    public function edit($id)
    {
        $movie = Movie::find($id);
        return view('movies/edit', ['movie' => $movie]);
    }

    public function update($id, Request $request)
    {
        // バリデーション作成
        DB::transaction(function () use ($id, $request) {
            $rules = [
                'title' => 'required|unique:movies',
                'image_url' => 'required|url',
                'published_year' => 'required|integer',
                'description' => 'required|max:255',
                'is_showing' => 'required',
                'genre' => 'required'
            ];
            $messages = [
                'title.required' => 'タイトルを入力してください',
                'title.unique' => 'タイトルは既に登録されています',
                'image_url.required' => '画像URLを入力してください',
                'image_url.url' => '画像URLを正しく入力してください',
                'published_year.required' => '公開年を入力してください',
                'description.max' => '概要は255文字以内で入力してください',
                'description.required' => '概要を入力してください',
                'is_showing.max' => '公開年を入力してください',
                'genre.required' => 'ジャンルを入力してください'
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                // バリデーションエラーが発生した場合の処理
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $movie = Movie::find($id);
            $updated_at = Carbon::now();
            $is_showing = ($request->is_showing == '上映中') ? true : false;
            $genreName = $request->input('genre');
            $genre = Genre::firstOrCreate(['name' => $genreName]);

            $movie->title = $request->title;
            $movie->image_url = $request->image_url;
            $movie->description = $request->description;
            $movie->published_year = $request->published_year;
            $movie->is_showing = $is_showing;
            $movie->updated_at = $updated_at->format('Y-m-d H:i:s');
            $movie->genre()->associate($genre);
            $movie->save();
        });
        return redirect('/admin/movies');
    }

    public function delete($id)
    {
        $movie = Movie::find($id);
        if (!$movie) {
            return response()->view('errors/notExists', ['message' => '映画が見つかりませんでした'], 404);
        }
        $movie->delete();
        // 削除完了メッセージをセッションに保存
        session()->flash('delete_success', '削除が完了しました');
        return redirect('/admin/movies');
    }
}
