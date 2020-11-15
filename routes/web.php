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


Route::group(['middleware'=>'web','prefix'=>'customer'], function () {
    Route::get('/','CustomerController@index')->name('customer.index');
    Route::get('/create','CustomerController@create')->name('customer.create');
    Route::post('/store','CustomerController@store')->name('customer.store');
    Route::get('/edit/{id}','CustomerController@edit')->name('customer.edit');
    Route::post('/update','CustomerController@update')->name('customer.update');
    Route::post('/delete','CustomerController@destroy')->name('customer.delete');
});
Route::group(['middleware'=>'web','prefix'=>'export'], function () {
    Route::get('/','CustomerController@index')->name('export.index');
    Route::get('/create','CustomerController@create')->name('export.create');
    Route::post('/store','CustomerController@store')->name('export.store');
    Route::get('/edit/{id}','CustomerController@edit')->name('export.edit');
    Route::post('/update','CustomerController@update')->name('export.update');
    Route::post('/delete','CustomerController@destroy')->name('export.delete');
});
Route::group(['middleware'=>'web','prefix'=>'product'], function () {
    Route::get('/','ProductController@index')->name('product.index');
    Route::get('/create','ProductController@create')->name('product.create');
    Route::post('/store','ProductController@store')->name('product.store');
    Route::get('/edit/{id}','ProductController@edit')->name('product.edit');
    Route::post('/update','ProductController@update')->name('product.update');
    Route::post('/delete','ProductController@destroy')->name('product.delete');
});
Route::post('/customers/export','CustomerController@export')->name('customer.export');
