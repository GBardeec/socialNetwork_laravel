<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// вкладки в навигации
Route::group(['namespace' => 'App\Http\Controllers\Main'], function () {
    Route::get('/', 'IndexController')->name('main.index');
});


Route::group(['namespace' => 'App\Http\Controllers\UserComments'], function () {
    Route::get('/comments', 'ShowController')->name('comments.show');
});

Route::group(['namespace' => 'App\Http\Controllers\Auth'], function () {
    Route::get('/login', 'LoginController')->name('auth.login');
    Route::post('/login', 'LoginController');
    Route::get('/logout', 'LogoutController')->name('auth.logout');
});


// работа с профилем
Route::group(['namespace' => 'App\Http\Controllers\Profiles', 'prefix' => 'profile'], function () {
    Route::get('/', 'IndexController')->name('profile.index');

    Route::get('/{profile}', 'ShowController')->name('profile.show');

    Route::get('/{profile}/load-more-comments', 'ShowController@loadMoreComments')->name('profile.load-more-comments');
});


Route::group(['namespace' => 'App\Http\Controllers\Comments', 'prefix' => 'profile', 'middleware' => ['auth', 'verified']], function () {
    Route::post('/comment/add/{profileId}', 'CreateController')->name('comment.add');
    Route::delete('/{profile}/comment/{comment}', 'DeleteController')->name('comment.delete');
    Route::post('/comment/reply/{parentComment}', 'CommentReplyController')->name('comment.reply');
});


