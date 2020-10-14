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



Route::namespace('Auth')->group(function(){
    Route::group(['middleware' => 'guest'], function () {
        Route::get('/','HomeController@welcome')->name('welcome');
        Route::get('/login','AuthController@showLoginForm')->name('login');
        Route::post('/login','AuthController@login');

        Route::get('/register','RegisterController@showRegistrationForm')->name('register');
        Route::post('/register','RegisterController@register');
        Route::get('/confirm','RegisterController@confirm')->name('register.confirm');

        Route::get('/reset','ResetPasswordController@showResetPasswordForm')->name('password.reset');
        Route::post('/reset','ResetPasswordController@reset')->name('password.email');
        Route::get('/password_confirm','ResetPasswordController@showConfirmationForm')->name('password.confirm');
        Route::post('/password_confirm','ResetPasswordController@confirm')->name('password.update');
    });

    Route::group(['middleware' => 'jwt.guard'], function () {
        Route::get('/home','HomeController@index')->name('home');
        Route::post('/logout','AuthController@logout')->name('logout');
    });
});

