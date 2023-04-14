<?php

use App\Http\Controllers\ApiGameController;
use App\Http\Controllers\Auth\AuthController;
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

//Route::get('/', function () {
//    $finished = DB::select('SELECT * FROM games WHERE finished = ?', [1]);
//    $opened = DB::select('SELECT * FROM games WHERE finished = ?', [0]);
//
//    return view('welcome', ['finished' => $finished, 'opened' => $opened]);
//});

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');
Route::get('/', [AuthController::class, 'dashboard'])->name('dashboard');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/games', [GameController::class, 'showAll']);
Route::get('game', [GameController::class, 'game'])->name('game');

Route::get('api/game/{id}', [ApiGameController::class, 'get']);
Route::post('api/game/{id}', [ApiGameController::class, 'update']);
