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
Route::get('/', [App\Http\Controllers\User\PollUnitController::class, 'index']);
Route::get('/lga_result', [App\Http\Controllers\User\LgaController::class, 'index']);
Route::get('/party', [App\Http\Controllers\User\PartyController::class, 'index']);
Route::post('/announced_poll_unit_result', [App\Http\Controllers\User\AnnouncedPollUnitResultController::class, 'store']);
//Route::get('/state', [App\Http\Controllers\User\StateController::class, 'index']);

//Route::get('/ward', [App\Http\Controllers\User\WardController::class, 'index']);
//Route::get('/poll_unit', [App\Http\Controllers\User\PollUnitController::class, 'index']);
//Route::get('/announced_poll_unit_result', [App\Http\Controllers\User\AnnouncedPollUnitResultController::class, 'index']);

