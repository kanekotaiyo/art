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
    Route::get('/past_use', 'ReserveController@past_use');
    Route::get('/past_use_pickup', 'MatchingController@past_use_pickup');
    Route::get('/mypage/{user}/edit', 'UserController@edit');
    Route::get('/mypage/{user}/image_edit', 'UserController@image_edit');
    Route::put('/mypage/{user}', 'UserController@update');
    Route::put('/mypage_image/{user}', 'UserController@update_image');
    Route::get('/allpage/{user}', 'UserController@allpage');
    Route::get('/reviewcomment/{user}', 'UserController@reviewcomment');
    Route::get('/myreserve', 'ReserveController@myreserve');
    Route::get('/myreserve/{reserve}', 'MatchingController@show');
    Route::delete('/myreserve/{reserve}', 'MatchingController@delete_reserve');
    Route::get('/create', 'ReserveController@create');
    Route::post('/store', 'ReserveController@store');
    Route::get('/allreserve', 'ReserveController@allreserve');
    Route::get('/matchlist', 'MatchingController@matchlist');
    Route::delete('/matchlist/{matching}', 'MatchingController@delete_matching');
    Route::get('/matching/{reserve}', 'MatchingController@matching');
    Route::get('/confirm/{matching}', 'MatchingController@matching_confirm');
    Route::get('/reservechat/{matching}', 'ChatController@reservechat');
    Route::post('/reservemessage/{matching}', 'ChatController@reservemessage');
    Route::get('/pickupchat/{matching}', 'ChatController@pickupchat');
    Route::post('/pickupmessage/{matching}', 'ChatController@pickupmessage');
    Route::get('/review/{matching}', 'ReviewController@review');
    Route::put('/reviewing/{matching}', 'ReviewController@reviewing');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
