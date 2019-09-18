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

Route::group(['prefix' => 'calendar'], function () {
    Route::get('/','CalendarController@getIndex');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('singup','AdminController@getSingup');
    Route::post('singup','AdminController@postSingup');

    Route::get('singin','AdminController@getSingin');
    Route::post('singin','AdminController@postSingin');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
