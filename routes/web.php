<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PodcastController;

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
    return view('auth.login');
});

Route::resource('podcast', PodcastController::class)->middleware('auth');

Auth::routes(['register' => false, 'reset'=> false]);

Route::get('/home', [PodcastController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [PodcastController::class, 'index'])->name('home');
});
