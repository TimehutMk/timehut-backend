<?php

use App\Http\Controllers\ShiftController;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::name('shift.')->prefix('/shift')->group(function () {
        Route::post('/start', [ShiftController::class, 'startShift'])->name('start');
        Route::post('/end', [ShiftController::class, 'endShift'])->name('end');
    });
});
