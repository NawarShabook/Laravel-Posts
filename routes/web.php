<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Routes for profile
Route::get('/profile',[ProfileController::class,'index'])->name('profile');
Route::put('/profile/update',[ProfileController::class,'update'])->name('profile.update');

//Routes for posts
Route::resource('/posts', PostController::class);
Route::get('/post/trashed',[PostController::class,'trashed'])->name('posts.trashed');
Route::get('post/hardDelete/{id}',[PostController::class,'hardDelete'])->name('posts.hardDelete');
Route::get('post/restore/{id}',[PostController::class,'restore'])->name('posts.restore');
//route for posts tags
Route::get('post/{tag_id}',[PostController::class,'tag_posts'])->name('tags.posts');
/*
    Route::get('/posts',[PostController::class,'index'])->name('posts');
    Route::get('/post/create',[PostController::class,'create'])->name('posts.create');
    Route::post('/post/store',[PostController::class,'store'])->name('post.store');
    Route::get('/post/show/{slug}',[PostController::class,'show'])->name('post.show');
    Route::get('/post/edit/{id}',[PostController::class,'edit'])->name('post.edit');
    Route::post('/posts/update/{id}',[PostController::class,'update'])->name('post.update');
    Route::get('/posts/destroy/{id}',[PostController::class,'destroy'])->name('post.destroy');
*/



//Routes for tags
Route::resource('tags', TagController::class);


//Routes for users
Route::resource('users',UserController::class);
