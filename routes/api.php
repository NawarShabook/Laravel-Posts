<?php

use App\Http\Controllers\API\PostController as APIPostController;
use App\Http\Controllers\API\RegisterController;
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
/*
    passport install
    Client ID: 1
    Client secret: MOmQrd31QetRbEwf5CDlczgqhEZj0nMOh8XQTidV
    Password grant client created successfully.
    Client ID: 2
    Client secret: PHx9axhOkRke8APWXFjjiOcI944UtIlLVEjeIm4m
*/
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('register',[RegisterController::class,'register']);
Route::post('login',[RegisterController::class,'login']);

Route::middleware('auth:api')->group(function(){
    Route::resource('posts',APIPostController::class);
    Route::get('post/user/{id}',[APIPostController::class,'userPosts']);
});
//group function for put more than one route
