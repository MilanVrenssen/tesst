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
use App\Http\Controllers\TemperatuurController;
Route::get('/', [TemperatuurController::class, 'index']);
Route::get('overzicht', 'App\Http\Controllers\TemperatuurController@detail');
Route::post('nieuwsbrief', 'App\Http\Controllers\TemperatuurController@nieuwsbrief');
