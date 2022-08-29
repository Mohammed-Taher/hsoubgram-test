<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
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


Route::get('/p/filters', function () {
    return view('posts.filters_page');
});
require __DIR__ . '/auth.php';

Route::get('/explore', [PostController::class, 'explore'])->name('explore');

Route::controller(PostController::class)->middleware('auth')->group(function () {
    Route::get('/', 'index')->name('home_page');
    Route::get('/p/create', 'create')->name('create_post');
    Route::post('/p/create', 'store')->name('store_post');
    Route::get('/p/{post:slug}', 'show')->name('show_post');
    Route::get('/p/filters', 'filters')->name('filters');
    Route::post('/p/filters', 'store_filtered')->name('store_filtered');
});

Route::post('/p/{post}/comment', [CommentController::class, 'store'])->name('store_comment');
Route::get('/p/{post:slug}/like', LikeController::class);
Route::post('/toggle_follow', [FollowController::class, 'toggle'])->name('toggle_follow');

Route::controller(UserController::class)->middleware('auth')->group(function () {
    Route::get('/{user:username}', [UserController::class, 'index'])->name('user_profile');
    Route::get('/{user:username}/edit', [UserController::class, 'edit'])->name('edit_profile');
    Route::post('/{user:username}', [UserController::class, 'store'])->name('update_profile');
});
