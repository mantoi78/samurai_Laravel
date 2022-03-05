<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\TodoController;

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

Route::get('/', [HomeController::class, 'index']);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource("goals", 'GoalController')->middleware('auth');

Route::resource("goals.todos", 'TodoController')->middleware('auth');
Route::post('/goals/{goal}/todos/{todo}/sort', [TodoController::class, 'sort'])->middleware('auth');

Auth::routes();


