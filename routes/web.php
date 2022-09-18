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
    Route::get('/allpage/{user}', 'UserController@allpage');
    Route::get('/myreserve', 'ReserveController@myreserve');
    Route::get('/myreserve/{reserve}', 'ReserveController@show');
    Route::get('/create', 'ReserveController@create');
    Route::post('/store', 'ReserveController@store');
    Route::get('/allreserve', 'ReserveController@allreserve');
    Route::get('/matchlist', 'MatchingController@matchlist');
    Route::get('/matching/{reserve}', 'MatchingController@matching');
    
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
