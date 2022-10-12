<?php

use App\Http\Controllers\API\UsersController;
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


Route::group(['middleware'=>['api','checkPassword']],function (){

    // API USERS
    Route::controller(UsersController::class)->prefix('users')->group(function (){
        Route::post('/','index');
        Route::post('/find/{id}','getUserById');
        Route::post('/create','createUser');
        Route::post('/change-password','changePassword');
    });
});
