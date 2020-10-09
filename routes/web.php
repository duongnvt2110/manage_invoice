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




Route::group(['middleware' => 'guest'], function () {
    Route::get('/','HomeController@welcome')->name('welcome');
    Route::get('/login','AuthController@showLoginForm')->name('login');
    Route::post('/login','AuthController@login');
});

Route::group(['middleware' => 'jwt.guard'], function () {
    Route::get('/home','HomeController@index')->name('home');
    Route::post('/logout','AuthController@logout')->name('logout');
});
