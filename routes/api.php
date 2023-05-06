<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('lgas/{state_id}', [App\Http\Controllers\User\LgaController::class, 'show']);
Route::get('ward/{lga_id}', [App\Http\Controllers\User\WardController::class, 'show']);
Route::get('/poll_unit/{ward_id}', [App\Http\Controllers\User\PollUnitController::class, 'show']);

Route::get('/poll_unit_id/{lga_id}', [App\Http\Controllers\User\PollUnitController::class, 'showAllpollId']);
//get the exact unique id of a poll unit 
Route::get('/poll_unit_id/{poll_id}/{ward_id}', [App\Http\Controllers\User\PollUnitController::class, 'pollid']);
//return all result of a particular poll unit
Route::get('/announced_poll_unit_result/{unique_id}', [App\Http\Controllers\User\AnnouncedPollUnitResultController::class, 'show']);
//return all result of a lga
Route::get('/announced_lga_result/{lga_id}', [App\Http\Controllers\User\AnnouncedPollUnitResultController::class, 'lgaresult']);
