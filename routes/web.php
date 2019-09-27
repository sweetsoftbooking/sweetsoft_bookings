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


    Route::group(['prefix' => 'booking'], function () {
        Route::get('/',[
        'as' => 'bookings.list',
        'uses' => 'BookingController@getIndex',
        'permission' => 'bookings.view'
        ]);
        Route::post('add',[
            'as' => 'bookings.create',
            'uses' => 'BookingController@postAdd',
            'permission' => 'bookings.create'
            ]);

        Route::get('listing',[
            'as' => 'bookings.listing',
            'uses' => 'BookingController@getListing',
            'permission' => 'bookings.view'
            ]);
        Route::get('rooms',[
            'as' => 'bookings.rooms',
            'uses' => 'BookingController@getRooms',
            // 'permission' => 'bookings.view'
            ]);
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

    Route::group(['prefix' => 'event'], function () {
        Route::get('add',[
            'as' => 'events.create',
            'uses' => 'EventController@getAdd',
            'permission' => 'events.create'
        ]);
        Route::post('add',[
            'as' => 'events.create',
            'uses' => 'EventController@postAdd',
            'permission' => 'events.create'
        ]);

        Route::get('/',[
            'as' => 'events.list',
            'uses' => 'EventController@getIndex',
            'permission' => 'events.view'
        ]);

        Route::get('edit/{id}',[
            'as' => 'events.edit',
            'uses' => 'EventController@getEdit',
            'permission' => 'events.edit'
        ]);
        Route::post('edit/{id}',[
            'as' => 'events.edit',
            'uses' => 'EventController@postEdit',
            'permission' => 'events.edit'
        ]);

        Route::get('delete/{id}',[
            'as' => 'events.delete',
            'uses' => 'EventController@getDelete',
            'permission' => 'events.delete'
        ]);
    });

    Route::group(['prefix' => 'room'], function () {
        Route::get('add',[
            'as' => 'rooms.create',
            'uses' => 'RoomController@getAdd',
            'permission' => 'rooms.create'
        ]);
        Route::post('add',[
            'as' => 'rooms.create',
            'uses' => 'RoomController@postAdd',
            'permission' => 'rooms.create'
        ]);

        Route::get('/',[
            'as' => 'rooms.list',
            'uses' => 'RoomController@getIndex',
            'permission' => 'rooms.view'
        ]);

        Route::get('edit/{id}',[
            'as' => 'rooms.edit',
            'uses' => 'RoomController@getEdit',
            'permission' => 'rooms.edit'
        ]);
        Route::post('edit/{id}',[
            'as' => 'rooms.edit',
            'uses' => 'RoomController@postEdit',
            'permission' => 'rooms.edit'
        ]);

        Route::get('delete/{id}',[
            'as' => 'rooms.delete',
            'uses' => 'RoomController@getDelete',
            'permission' => 'rooms.delete'
        ]);
    });

    Route::get('logout','AdminController@getLogout');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
