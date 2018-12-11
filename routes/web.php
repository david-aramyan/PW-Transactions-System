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

Route::get('/', 'Auth\LoginController@showLoginForm');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::get('history', 'TransactionController@history')->name('history');
    Route::get('newTransaction', 'TransactionController@create')->name('newTransaction');
    Route::post('transaction', 'TransactionController@store')->name('transaction');
    Route::get('usersJson', 'UserController@listJson')->name('usersJson');

    Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => 'admin'], function () {
        Route::get('/test', function (){
            echo "<a href='".route('admin.hambal')."'>test</a>";
        })->name('hambal');
    });
});
