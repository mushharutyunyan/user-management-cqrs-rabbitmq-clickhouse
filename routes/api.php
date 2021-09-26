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

Route::group(['middleware' => 'auth:api'], function () {
    Route::group(['prefix' => 'user','as' => '.user'], function () {
        Route::post('/', [\App\Http\Controllers\Users\CommandController::class,'store']);
        Route::delete('/{id}', [\App\Http\Controllers\Users\CommandController::class,'delete']);
        Route::get('/getAll', [\App\Http\Controllers\Users\QueryController::class,'getAll']);
    });
});
