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


Route::group([
    'prefix' => 'admin','middleware'=>'auth'
    ], function () {
    
    Route::get('/',[
        'as' => 'admin.index',
        'uses' => 'AdminController@getIndex',

    ]);
    Route::group(['prefix' => 'calendar'], function () {
        Route::get('/','CalendarController@getIndex');
    });

    Route::group(['prefix' => 'role'], function () {
        Route::get('add',[
            'as' => 'roles.create',
            'uses' => 'RoleController@getAdd',
            'permission' => 'roles.create'
        ]);
        Route::post('add',[
            'as' => 'roles.create',
            'uses' => 'RoleController@postAdd',
            'permission' => 'roles.create'
        ]);
        
        // route('evens.list', ['id' => '1', 'name' => 'value']) -> url('admin/role/create');
        Route::get('/', [
            'as' => 'roles.list',
            'uses' => 'RoleController@getIndex',
            'permission' => 'roles.view'
        ]);

        Route::get('edit/{id?}',[
            'as' => 'roles.edit',
            'uses' => 'RoleController@getEdit',
            'permission' => 'roles.edit'
        ]);
        Route::post('edit/{id?}',[
            'as' => 'roles.add',
            'uses' => 'RoleController@postEdit',
            'permission' => 'roles.edit'
        ]);

        Route::get('delete/{id?}',[
            'as' => 'roles.delete',
            'uses' => 'RoleController@getDelete',
            'permission' => 'roles.delete'
        ]);
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('add',[
            'as' => 'users.create',
            'uses' => 'UserController@getAdd',
            'permission' => 'users.create'
        ]);
        Route::post('add',[
            'as' => 'users.create',
            'uses' => 'UserController@postAdd',
            'permission' => 'users.create'
        ]);

        Route::get('/',[
            'as' => 'users.list',
            'uses' => 'UserController@getIndex',
            'permission' => 'users.view'
        ]);

        Route::get('edit/{id}',[
            'as' => 'users.edit',
            'uses' => 'UserController@getEdit',
            'permission' => 'users.edit'
        ]);
        Route::post('edit/{id}',[
            'as' => 'users.edit',
            'uses' => 'UserController@postEdit',
            'permission' => 'users.edit'
        ]);

        Route::get('delete/{id}',[
            'as' => 'users.delete',
            'uses' => 'UserController@getDelete',
            'permission' => 'users.delete'
        ]);
    });

    Route::get('logout','AdminController@getLogout');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
