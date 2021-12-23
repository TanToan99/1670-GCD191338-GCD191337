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
Route::get('/management/user/{id}/assign','Management\UserController@assign')->name('management.user.assign');
Route::post('/management/user/{id}/assign','Management\UserController@assignCourse')->name('management.user.assign');
Route::get('/management/dt-row-data', 'Management\UserController@getDtRowData');
Route::get('/management/user/{id}/assign','Management\UserController@assign')->name('management.user.assign');
Route::post('/management/user/{id}/assign','Management\UserController@assignCourse')->name('management.user.assignCourse');
Route::get('/management/user/{id}/{course}/remove','Management\UserController@removeAssignCourse')->name('management.course.remove');
Route::get('/management/user/course/dt-row-data','Management\UserController@getCourseRowData');

Route::get('/trainee/trainee-courses','Trainee\TraineeController@index')->name('trainee.trainee_course');
Route::get('/trainee/dt-row-data', 'Trainee\TraineeController@getDtRowData');
Route::get('/trainee/trainee_in_course/{id}', 'Trainee\TraineeController@trainee')->name('trainee.trainee_in_course');
Route::get('/trainee/tnee-row-data', 'Trainee\TraineeController@getTneeRowData');

Route::get('/trainer/trainer-courses','Trainer\TrainerController@index')->name('trainer.trainer_course');
Route::get('/trainer/dt-row-data', 'Trainer\TrainerController@getDtRowData');
Route::get('/trainer/trainer_in_course/{id}', 'Trainer\TrainerController@trainer')->name('trainer.trainer_in_course');
Route::get('/trainer/tner-row-data', 'Trainer\TrainerController@getTnerRowData');


Route::get('/profile','UserController@index')->name('profile');
Route::post('/profile/edit','UserController@update')->name('profile.update');

Route::get('/category','Management\CategoryController@index')->name('category.index');
Route::get('/category/dt-row-data', 'Management\CategoryController@getDtRowData');
Route::get('/category/create','Management\CategoryController@create')->name('category.create');
Route::post('/category/store','Management\CategoryController@store')->name('category.store');
Route::get('/category/remove/{id}','Management\CategoryController@remove')->name('category.remove');
Route::get('/category/edit/{id}','Management\CategoryController@edit')->name('category.edit');
Route::post('/category/edit/{id}','Management\CategoryController@update')->name('category.update');
Route::get('/category/courses/{id}','Management\CategoryController@courses')->name('category.courses');

Route::get('/course','Management\CourseController@index')->name('course.index');
Route::get('/course/dt-row-data', 'Management\CourseController@getDtRowData');
Route::get('/course/create','Management\CourseController@create')->name('course.create');
Route::post('/course/store','Management\CourseController@store')->name('course.store');
Route::get('/course/remove/{id}','Management\CourseController@remove')->name('course.remove');
Route::get('/course/edit/{id}','Management\CourseController@edit')->name('course.edit');
Route::post('/course/edit/{id}','Management\CourseController@update')->name('course.update');
Route::get('/course/view/{id}','Management\CourseController@viewUserinCourse')->name('course.viewUsers');
Route::get('/course/user/{id}/{user}/remove','Management\CourseController@removeuserincourse')->name('course.remove.user');
Route::get('/course/user-row-data', 'Management\CourseController@getUsersRowData');
