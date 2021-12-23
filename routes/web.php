<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::redirect('/', '/home');
Route::get('logout', 'Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/management/user','Management\UserController@index')->name('management.index');
Route::get('/trainer/trainer-courses','Trainer\TrainerController@index')->name('trainer.trainer_course');
Route::get('/management/dt-row-data', 'Management\UserController@getDtRowData');
Route::get('/trainer/dt-row-data', 'Trainer\TrainerController@getDtRowData');