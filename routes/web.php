<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
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

Route::get('/', [HomeController::class, 'index']);
Route::get('/posts', [HomeController::class, 'posts']);
Route::get('/posts/{post}', [HomeController::class, 'post'])->whereNumber('post')->name('post');
Route::get('/tag/{tag}', [HomeController::class, 'tag']);
Route::get('/user/{user}', [HomeController::class, 'user']);

//Route::get('/admin/posts', [PostController::class, 'index']);
//Route::get('/admin/posts/create', [PostController::class, 'create']);
//Route::get('/admin/posts/{post}/edit', [PostController::class, 'edit']);
//Route::get('/admin/posts/{post}/delete', [PostController::class, 'destroy']);
//Route::post('/admin/posts', [PostController::class, 'store']);
//Route::post('/admin/posts/{post}', [PostController::class, 'update']);

Route::middleware(['auth'])->group(function() {
    Route::resource('/admin/posts', PostController::class);
    Route::post('/post/{post}', [\App\Http\Controllers\CommentController::class, 'store']);
    Route::get('/post/{post}/like', [\App\Http\Controllers\LikeController::class, 'store'])->name('post.like');
    Route::get('/user/profile', function() {
        return view('profile');
    })->name('profile');
});
