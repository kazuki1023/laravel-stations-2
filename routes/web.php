<?php

use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


use App\Http\Controllers\PracticeController;
use Illuminate\Routing\Route as RoutingRoute;

// Route::get('URL', [Controllerの名前::class, 'Controller内のfunction名']);
Route::get('/practice', [PracticeController::class, 'sample']);
Route::get('/practice2', [PracticeController::class, 'sample2']);
Route::get('/practice3', [PracticeController::class, 'sample3']);
Route::get('/getPractice', [PracticeController::class, 'getPractice']);
Route::get('/movies', [MovieController::class, 'show']);
// 詳細
Route::get('/movies/{id}', [MovieController::class, 'detail']);
Route::get('/admin/movies', [MovieController::class, 'showAdmin']);

Route::post('/admin/movies/store', [MovieController::class, 'store']);
Route::get('/admin/movies/create', [MovieController::class, 'register']);
Route::get('/admin/schedules', [MovieController::class, 'showSchedule']);

// 編集
Route::get('admin/movies/{id}/edit', [MovieController::class, 'edit']);
Route::patch('admin/movies/{id}/update', [MovieController::class, 'update']);

// 削除
Route::delete('admin/movies/{id}/destroy', [MovieController::class, 'delete']);

// 座席表
Route::get('/sheets', [MovieController::class, 'sheets']);





