<?php

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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::group(['prefix' => 'contact', 'middleware' => 'auth'], function () {
    Route::get('index', 'ContactFormController@index')->name('contact.index');
    Route::get('create', 'ContactFormController@create')->name('contact.create');
    Route::post('store', 'ContactFormController@store')->name('contact.store');
    Route::get('show/{id}', 'ContactFormController@show')->name('contact.show');
    Route::get('edit/{id}', 'ContactFormController@edit')->name('contact.edit');
    Route::post('update/{id}', 'ContactFormController@update')->name('contact.update');
    Route::post('destroy/{id}', 'ContactFormController@destroy')->name('contact.destroy');
});

Route::group(['middleware' => 'auth'], function () {

    // ユーザ関連
    Route::resource('users', 'UsersController', ['only' => ['index', 'show', 'edit', 'update']]);

    // フォロー/フォロー解除を追加
    Route::post('users/{user}/follow', 'UsersController@follow')->name('follow');
    Route::delete('users/{user}/unfollow', 'UsersController@unfollow')->name('unfollow');

    // ツイート関連
    Route::resource('tweets', 'TweetsController', ['only' => ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']]);

    // 筋トレ種目関連
    Route::resource('events', 'EventsController', ['only' => ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']]);
    Route::post('event_select', 'EventsController@event_select')->name('event_select');

    // トレログ使用時のsession関係
    Route::get('sessions', 'SessionsController@index');
    Route::post('sessions', 'SessionsController@store');
    Route::get('sessions/delete', 'SessionsController@destroy');

    // コメント関連
    Route::resource('comments', 'CommentsController', ['only' => ['store']]);

    // いいね関連
    Route::resource('favorites', 'FavoritesController', ['only' => ['store', 'destroy']]);
});