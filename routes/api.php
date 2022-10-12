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


Route::group(['middleware'=>'api'],function (){

    // API USERS
    Route::controller(UsersController::class)->group(function (){
        Route::get('users','index');
        Route::get('users/{id}','getUserById');
        Route::post('create-user','createUser');
        Route::post('change-user-password','changePassword');
    });
});
