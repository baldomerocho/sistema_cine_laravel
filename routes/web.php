<?php

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/add-movie', function () {
        return view('add-movie');
    })->name('add-movie');

    Route::get('/horarios', function () {
        return view('horarios');
    })->name('horarios');
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
