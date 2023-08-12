<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Genre;
use App\Models\Sheet;
use App\Models\Schedule;
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

    function detailAdmin($id)
    {
        $movie = Movie::with('schedules')->find($id);
        return view('movies/detail', ['movie' => $movie]);
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

    public function detail($id)
    {
        $movie = Movie::find($id);
        $schedules = $movie->schedules->sortBy('start_time');
        return view('detail', ['movie' => $movie, 'schedules' => $schedules]);
    }

    public function showSchedule()
    {
        $moviesWithSchedules = Movie::whereHas('schedules')->with('schedules')->paginate(10);
        return view('movies/schedules', ['movies' => $moviesWithSchedules]);
    }

    public function detailSchedule($id)
    {
        $schedules = Schedule::with('movie')->find($id);
        // dd($schedules);
        return view('movies/schedule/detail', ['schedules' => $schedules]);
    }

    public function editSchedule($id)
    {
        $schedules = Schedule::with('movie')->find($id);
        $start_time_date = Carbon::parse($schedules->start_time)->format('Y-m-d');
        $start_time_time = Carbon::parse($schedules->start_time)->format('H:i');
        $end_time_date = Carbon::parse($schedules->end_time)->format('Y-m-d');
        $end_time_time = Carbon::parse($schedules->end_time)->format('H:i');
        return view('movies/schedule/edit', ['schedules' => $schedules, 'start_time_date' => $start_time_date, 'start_time_time' => $start_time_time, 'end_time_date' => $end_time_date, 'end_time_time' => $end_time_time]);
    }

    public function updateSchedule(Request $request)
    {
        // dd($request->all());
        DB::transaction(function () use ($request) {
            $rules = [
                'start_time_date' => 'required|date',
                'start_time_time' => 'required',
                'end_time_date' => 'required|date',
                'end_time_time' => 'required'
            ];
            $messages = [
                'start_time_date.required' => '開始日時を入力してください',
                'start_time_date.date' => '開始日時は既に登録されています',
                'start_time_time.required' => '開始時間を入力してください',
                'end_time_date.required' => '終了時間を入力してください',
                'end_time_date.date' => '終了日時は255文字以内で入力してください',
                'end_time_time.required' => '終了時間を入力してください'
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                // バリデーションエラーが発生した場合の処理
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $schedules = Schedule::find($request->schedule_id);
            $start_time = Carbon::parse($request->start_time_date . ' ' . $request->start_time_time);
            $end_time = Carbon::parse($request->end_time_date . ' ' . $request->end_time_time);
            $schedules->start_time = $start_time->format('Y-m-d H:i:s');
            $schedules->end_time = $end_time->format('Y-m-d H:i:s');
            $schedules->save();
            session()->flash('successUpdate', '問題の更新に成功しました');
        });
        // dd(session()->all());
        return redirect('/admin/schedules');
    }

    public function deleteSchedule($id)
    {
        $schedules = Schedule::find($id);
        $schedules->delete();
        session()->flash('successDelete', '問題の削除に成功しました');
        return redirect('/admin/schedules');
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

    // 座席表
    public function sheets()
    {
        $sheets = Sheet::all();
        // 行ごとに分ける
        $groupedSheets = $sheets->groupBy('row');
        return view('sheets', compact('groupedSheets'));
    }
}
