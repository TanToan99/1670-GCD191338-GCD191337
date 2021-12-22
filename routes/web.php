<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::redirect('/', '/home');
Route::get('logout', 'Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/management/user','Management\UserController@index')->name('management.index');
Route::get('/management/dt-row-data', 'Management\UserController@getDtRowData');