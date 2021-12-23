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
Route::get('/management/dt-row-data', 'Management\UserController@getDtRowData');

Route::get('/trainee/trainee-courses','Trainee\TraineeController@index')->name('trainee.trainee_course');
Route::get('/trainee/dt-row-data', 'Trainee\TraineeController@getDtRowData');
Route::get('/trainee/trainee_in_course/{id}', 'Trainee\TraineeController@trainee')->name('trainee.trainee_in_course');
Route::get('/trainee/tnee-row-data', 'Trainee\TraineeController@getTneeRowData');

Route::get('/trainer/trainer-courses','Trainer\TrainerController@index')->name('trainer.trainer_course');
Route::get('/trainer/dt-row-data', 'Trainer\TrainerController@getDtRowData');
Route::get('/trainer/trainer_in_course/{id}', 'Trainer\TrainerController@trainer')->name('trainer.trainer_in_course');
Route::get('/trainer/tner-row-data', 'Trainer\TrainerController@getTnerRowData');


Route::get('/profile','UserController@index')->name('profile');