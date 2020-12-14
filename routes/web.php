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

// Route::get('指定したルートのURI', '実行するメソッド');

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'HomeController@index')->name('home');
// コントローラのコンストラクタで、middlewareメソッドを使い、コントローラのアクションに対するミドルウェアを簡単に指定できます。グループ中の全ルートにミドルウェアを指定するには、そのグループを定義する前にmiddlewareメソッドを使用します
// 'prefix' => 'contactでフォルダを指定することができ、頭につくcontact省略できる。'middleware' => 'auth'で認証機能 コールバックファンクションに通常のルーティングかく
Route::group(['prefix' => 'contact', 'middleware' => 'auth'], function () {
    // ->name('contact.index')を使用することで名前がつきviewが書きやすくなる
    Route::get('index', 'ContactFormController@index')->name('contact.index');
    Route::get('create', 'ContactFormController@create')->name('contact.create');
    Route::post('store', 'ContactFormController@store')->name('contact.store');
    Route::get('show/{id}', 'ContactFormController@show')->name('contact.show');
    Route::get('edit/{id}', 'ContactFormController@edit')->name('contact.edit');
    Route::post('update/{id}', 'ContactFormController@update')->name('contact.update');
    Route::post('destroy/{id}', 'ContactFormController@destroy')->name('contact.destroy');
});

// Route::resource('contacts', 'ContactFormController')->only([
//     'index', 'show'
// ]);

// 認証（デフォルト）

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// ログイン状態
// このクロージャーの中にルートを設定することでログインした時にしかアクセス出来ないようにします。
Route::group(['middleware' => 'auth'], function () {

    // ユーザ関連
    // ResourceControllerにすることでシステムが自動的にそれぞれのアクションに紐づけてくれる
    // ユーザ機能では一覧/詳細/編集/更新のみを使用するので第３引数にonlyと記述して使うアクションのみを設定
    Route::resource('users', 'UsersController', ['only' => ['index', 'show', 'edit', 'update']]);

    // フォロー/フォロー解除を追加
    Route::post('users/{user}/follow', 'UsersController@follow')->name('follow');
    Route::delete('users/{user}/unfollow', 'UsersController@unfollow')->name('unfollow');

    // ツイート関連
    Route::resource('tweets', 'TweetsController', ['only' => ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']]);

    // 筋トレ種目関連
    Route::resource('events', 'EventsController', ['only' => ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']]);
    Route::post('event_select', 'eventsController@event_select')->name('event_select');
    Route::get('sessions', 'SessionsController@index');
    Route::post('sessions', 'SessionsController@store');
    Route::get('sessions/delete', 'SessionsController@destroy');

    // コメント関連
    Route::resource('comments', 'CommentsController', ['only' => ['store']]);

    // いいね関連
    // いいね機能では保存のstoreと削除のdestroyを設定
    Route::resource('favorites', 'FavoritesController', ['only' => ['store', 'destroy']]);
});
