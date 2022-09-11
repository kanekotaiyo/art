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

Route::group(['middleware' => ['auth']], function(){
    Route::get('/', 'UserController@top');
    Route::get('/mypage', 'UserController@mypage');
    Route::get('/myreserve', 'UserController@myreserve');
    Route::get('/allreserve', 'UserController@allreserve');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
