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