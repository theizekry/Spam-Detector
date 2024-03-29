<?php

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::group(['middleware' => ['auth']], function() {

    Route::get('/', function () {
        return view('Posts.create');
    });

    Route::group(['namespace' => 'Posts'], function() {

        Route::get('/posts/create', 'PostController@create')->name('posts.create');

        Route::post('/posts', 'PostController@store')
                ->name('posts.store')
                ->middleware('SpamDetector');
    });
});