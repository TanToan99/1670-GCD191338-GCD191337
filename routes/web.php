<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::redirect('/', '/home');
Route::get('logout', 'Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/management/user','Management\UserController@index')->name('management.index');
Route::get('/management/dt-row-data', 'Management\UserController@getDtRowData');
Route::get('/management/user/edit/{id}','Management\UserController@edit')->name('management.user.edit');
Route::post('/management/user/edit/{id}','Management\UserController@update')->name('management.user.update');
Route::get('/management/user/remove/{id}','Management\UserController@remove')->name('management.user.remove');
Route::get('/management/user/create','Management\UserController@create')->name('management.user.create');
Route::post('/management/user/store','Management\UserController@store')->name('management.user.store');

Route::get('/category/user','Management\CategoryController@index')->name('category.index');
Route::get('/category/dt-row-data', 'Management\CategoryController@getDtRowData');
Route::get('/category/create','Management\CategoryController@create')->name('category.create');
Route::post('/category/store','Management\CategoryController@store')->name('category.store');
Route::get('/category/remove/{id}','Management\CategoryController@remove')->name('category.remove');
Route::get('/category/edit/{id}','Management\CategoryController@edit')->name('category.edit');
Route::post('/category/edit/{id}','Management\CategoryController@update')->name('category.update');