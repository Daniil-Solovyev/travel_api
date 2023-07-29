<?php

use App\Http\Controllers\Api\V1\TravelController;
use App\Http\Controllers\Api\V1\TourController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Admin\TravelController as AdminTravelController;

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

//Route::prefix('v1')->group(function () {
//    //
//});

Route::get('travels', [TravelController::class, "index"]);
Route::get('travels/{travel:slug}/tours', [TourController::class, "index"]);

Route::prefix('admin')->middleware('role:admin')->group(function () {
    Route::post('travels', [AdminTravelController::class, "store"]);
});

Route::post('login', LoginController::class)->name('login');
