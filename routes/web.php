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

Route::group(['middleware'=>'jwt.guard','prefix'=>'role'], function () {
    Route::get('/','RoleController@index')->name('role.index');
    Route::get('/create','RoleController@create')->name('role.create');
    Route::post('/store','RoleController@store')->name('role.store');
    Route::get('/edit/{id}','RoleController@edit')->name('role.edit');
    Route::post('/update/{id}','RoleController@update')->name('role.update');
    Route::post('/delete/{id}','RoleController@destroy')->name('role.delete');
});

Route::group(['middleware'=>'jwt.guard','prefix'=>'permission'], function () {
    Route::get('/','PermissionController@index')->name('permission.index');
    Route::get('/create','PermissionController@create')->name('permission.create');
    Route::post('/store','PermissionController@store')->name('permission.store');
    Route::get('/edit/{id}','PermissionController@edit')->name('permission.edit');
    Route::post('/update/{id}','PermissionController@update')->name('permission.update');
    Route::post('/delete/{id}','PermissionController@destroy')->name('permission.delete');
});

Route::group(['middleware'=>'jwt.guard','prefix'=>'user'], function () {
    Route::get('/','UserController@index')->name('user.index');
    Route::get('/create','UserController@create')->name('user.create');
    Route::post('/store','UserController@store')->name('user.store');
    Route::get('/edit/{id}','UserController@edit')->name('user.edit');
    Route::post('/update/{id}','UserController@update')->name('user.update');
    Route::post('/delete/{id}','UserController@destroy')->name('user.delete');
});

Route::group(['middleware'=>'jwt.guard','prefix'=>'loan'], function () {
    Route::get('/','LoanApplicationController@index')->name('loan.index');
    Route::get('/create','LoanApplicationController@create')->name('loan.create');
    Route::post('/sendAnalyst/{id}','LoanApplicationController@sendAnalyst')->name('loan.sendAnalyst');
    Route::post('/store','LoanApplicationController@store')->name('loan.store');
    Route::get('/edit/{id}','LoanApplicationController@edit')->name('loan.edit');
    Route::post('/update/{id}','LoanApplicationController@update')->name('loan.update');
    Route::post('/delete/{id}','LoanApplicationController@destroy')->name('loan.delete');
});
