<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
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
    return redirect('home');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/home', [App\Http\Controllers\PostController::class, 'index'])->name('home');

    Route::resource('posts', '\App\Http\Controllers\PostController');
    Route::resource('profiles', '\App\Http\Controllers\UserController');
    Route::get('posts/edit/{id}', [PostController::class, 'edit'])->name('posts.edit');
    Route::post('posts/update/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::post('comments', [CommentController::class, 'store'])->name('comments.store');
});
