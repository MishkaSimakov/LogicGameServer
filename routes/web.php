<?php

use App\Http\Controllers\LevelController;
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
    return view('welcome');
});

Route::resource('level', LevelController::class)->middleware('auth');

Route::get('level/{level}/moveup', [LevelController::class, 'moveUp'])->middleware('auth')->name('level.move-up');
Route::get('level/{level}/movedown', [LevelController::class, 'moveDown'])->middleware('auth')->name('level.move-down');

Auth::routes(['register' => false, 'reset' => false, 'confirm' => false]);
