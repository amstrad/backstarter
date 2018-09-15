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

Route::get('/', 'Home@index');

Route::group(['middleware' => ['guest']], function () {
    Route::get('/admin', 'Auth\LoginController@showLoginForm');
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'Auth\LoginController@login')->name('login');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/admin/logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('/admin', 'Admin\DashboardController@index')->name('admin');

    //list posts
    Route::get('/admin/posts/{page?}', 'Admin\PostController@index');
    Route::post('/admin/posts/delete/', 'Admin\PostController@delete');
    //single post
    Route::get('/admin/posts/single/{id?}', 'Admin\PostController@edit');
    Route::post('/admin/posts/single/{id?}', 'Admin\PostController@store');

    //list users
    Route::get('/admin/users/{page?}', 'Admin\UsersController@index');
    Route::post('/admin/users/delete/', 'Admin\UsersController@delete');
    //single user
    Route::get('/admin/users/single/{id?}', 'Admin\UsersController@edit');
    Route::post('/admin/users/single/{id?}', 'Admin\UsersController@store');


    //others
    Route::get('/admin/settings', 'Admin\DashboardController@settings')->name('settings');
    Route::get('/admin/switch_theme', 'Admin\DashboardController@swith_theme')->name('swith_theme');

});
