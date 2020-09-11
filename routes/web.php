<?php

use Illuminate\Support\Facades\Route;

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



Auth::routes();
Route::group(['middleware' => ['auth', 'auth']], function() {
    Route::get('/', function () {
        return view('home');
    });
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/index', 'ShortController@index')->name('index');
    Route::post('/store', 'ShortController@store')->name('store');
    Route::get('/logout', 'UserController@logout');

});
Route::get('/{url}', 'HomeController@loadPage');