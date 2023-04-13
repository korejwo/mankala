<?php

use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\DB;
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
    $finished = DB::select('SELECT * FROM games WHERE finished = ?', [1]);
    $opened = DB::select('SELECT * FROM games WHERE finished = ?', [0]);

    return view('welcome', ['finished' => $finished, 'opened' => $opened]);
});

Route::get('/games', [GameController::class, 'showAll']);
