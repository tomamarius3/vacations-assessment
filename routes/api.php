<?php

use App\Http\Controllers\VacationController;
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


Route::get('vacations', [VacationController::class, 'index']);
Route::get('vacations/{id}', [VacationController::class, 'show']);
Route::post('vacations', [VacationController::class, 'store']);
Route::put('vacations/{id}', [VacationController::class, 'update']);
Route::delete('vacations/{id}', [VacationController::class, 'destroy']);
