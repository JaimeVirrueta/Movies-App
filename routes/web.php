<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\TurnController;
use Illuminate\Support\Facades\Auth;
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
    return view('home');
});

Route::get('movies', [MovieController::class, 'index'])->name('movie.index');
Route::get('turns', [TurnController::class, 'index'])->name('turn.index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
