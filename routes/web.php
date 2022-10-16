<?php

use App\Models\Cine\Application\Sale;
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

    Route::get('/entradas', function () {
        return view('entradas');
    })->name('entradas');


});
Route::get('/ticket/{$ticket}', function ($ticket) {
    try{
        $tt = Sale::where('ticket', $ticket)->with('show.movie','seats')->firstOrFail();
        return view('livewire.modal-ticket',compact('tt'));
    }catch (\Exception $e){
        \Illuminate\Support\Facades\Log::error($e->getMessage());
        return view('livewire.not-found');
    }
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
