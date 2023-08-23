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
    Route::get('/login', 'IndexController')->name('auth.index');
    Route::post('/login', 'AuthController')->name('auth.login');
    Route::get('/logout', 'LogoutController')->name('auth.logout');
});


// работа с профилем
Route::group(['namespace' => 'App\Http\Controllers\Profiles', 'prefix' => 'profile'], function () {
    Route::get('/', 'IndexController')->name('profile.index');
    Route::get('/{profile}', 'ShowController')->name('profile.show');
    Route::get('/{profile}/load-more-comments', 'ShowController@loadMoreComments')->name('profile.load-more-comments');

    Route::group(['namespace' => 'Library', 'prefix' => '{profileId}/library', 'middleware' => ['auth','library.access']], function () {
        Route::get('/', 'IndexController')->name('library.index');
        Route::get('/{book}', 'ShowController')->name('library.show');
    });

    Route::group(['namespace' => 'Library', 'prefix' => '{profileId}/library', 'middleware' => 'public.book.access'], function () {
        Route::get('/{book}', 'ShowController')->name('library.show');
    });


    Route::group(['namespace' => 'LibraryAccess', 'prefix' => '{profileId}'], function () {
        Route::post('/give-access', 'GiveController')->name('library.give-access.index');
        Route::post('/revoke-access', 'RevokeController')->name('library.revoke-access.index');
    });
});


Route::group(['namespace' => 'App\Http\Controllers\Comments', 'prefix' => 'profile'], function () {
    Route::post('/comment/add/{profileId}', 'CreateController')->name('comment.add');
    Route::delete('/{profile}/comment/{comment}', 'DeleteController')->name('comment.delete');
    Route::post('/comment/reply/{parentComment}', 'CommentReplyController')->name('comment.reply');
});


// работа с книгами
Route::group(['namespace' => 'App\Http\Controllers\Book', 'prefix' => 'book'], function () {
    Route::get('/', 'IndexController')->name('book.index');
    Route::get('/create', 'CreateController')->name('book.create');
    Route::post('/', 'StoreController')->name('book.store');
    Route::get('/{book}', 'ShowController')->name('book.show');
    Route::get('/{book}/edit', 'EditController')->name('book.edit');
    Route::patch('/{book}', 'UpdateController')->name('book.update');
    Route::delete('/{book}', 'DeleteController')->name('book.delete');

    Route::post('{profileId}/library/book/{bookId}/make-public', 'LinkAccessController')->name('library.make-public');
});



