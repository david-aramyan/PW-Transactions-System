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
    Route::get('balance', 'UserController@getBalance')->name('balance');
    Route::get('newTransaction', 'TransactionController@create')->name('newTransaction');
    Route::get('duplicate/{transaction}', 'TransactionController@duplicate')->name('duplicate');
    Route::post('transaction', 'TransactionController@store')->name('transaction');

    Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => 'admin'], function () {
        //Users
        Route::get('users', 'UserController@index')->name('users');
        Route::get('users/{user}/edit', 'UserController@edit')->name('user.edit');
        Route::delete('users/{user}', 'UserController@destroy')->name('user.ban');
        Route::post('users/{id}', 'UserController@restore')->name('user.restore');
        Route::put('users/{user}', 'UserController@update')->name('user.update');

        //Transactions
        Route::get('transactions', 'TransactionController@index')->name('transactions');
        Route::delete('transactions/{transaction}', 'TransactionController@destroy')->name('transactions.cancel');
    });
});
