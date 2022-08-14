<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\YearController;
use App\Http\Controllers\API\CarModelController;

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


Route::post('cars', [CarModelController::class, 'storeCar'])->name('cars');
Route::get('cars/{id}', [CarModelController::class, 'getCar'])->name('get.cars');
Route::post('cars/{id}/years', [YearController::class, 'storeYear'])->name('store.year');
Route::get('cars', [YearController::class, 'getCarByYear'])->name('getCarBy.year');