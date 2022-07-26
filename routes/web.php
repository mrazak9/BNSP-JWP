<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
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
    Route::get('profiles/edit/{id}', [UserController::class, 'edit'])->name('profiles.edit');
    Route::post('profiles/update/{id}', [UserController::class, 'update'])->name('profiles.update');
    Route::get('posts/edit/{id}', [PostController::class, 'edit'])->name('posts.edit');
    Route::get('posts/cari', [PostController::class, 'cari'])->name('posts.cari');

    Route::post('posts/update/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::get('posts/destroy/{id}', [PostController::class, 'destroy'])->name('posts.delete');
    Route::post('comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('comments/edit/{id}', [CommentController::class, 'edit'])->name('comments.edit');
    Route::post('comments/update/{id}', [CommentController::class, 'update'])->name('comments.update');
    Route::post('comments/destroy/{id}', [CommentController::class, 'destroy'])->name('comments.delete');
});
