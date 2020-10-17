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

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/login', 'LoginCustom@login')->name('login');
Route::group(['middleware' => 'auth'], function(){

Route::post('user/deposit', 'UserController@deposit')->name('user.deposit');
Route::post('user/withdraw', 'UserController@withdraw')->name('user.withdraw');
Route::get('game/bitcoin', 'BettingController@index')->name('game.bitcoin');
Route::get('game/bitmex', 'BettingController@bitmex')->name('game.bitmex');


});
