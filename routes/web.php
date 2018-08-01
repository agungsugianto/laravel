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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'admin','middleware'=>['auth', 'role:admin']], function () {
    //isi route disini
    Route::resource('authors', 'AuthorController');
    Route::resource('books', 'BookController');
});
Route::get('/', 'GuestController@index');

Route::get('books/{book}/borrow',[
    'middleware'=>['auth', 'role:member'],
    'as'=>'guest.books.borrow',
    'uses'=>'BookController@borrow'
    ]);

    Route::put('books/{book}/return',[
    'middleware'=>['auth', 'role:member'],
    'as'=>'member.books.return',
    'uses'=>'BookController@returnBack'
    ]);
    Route::get('auth/verify/{token}', 'Auth\RegisterController@verify');
    Route::get('auth/send-verification', 'Auth\RegisterController@sendVerification');
    Route::get('settings/profile', 'SettingController@profile');
    Route::get('settings/profile/edit', 'SettingController@editProfile');
    Route::post('settings/profile', 'SettingController@updateProfile');
    Route::get('settings/password', 'SettingController@editPassword');
    Route::post('settings/password', 'SettingController@updatePassword');
    Route::resource('members', 'MemberController');
