<?php

use Illuminate\Support\Facades\Route;

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false
]);

Route::redirect('/', '/home');
Route::get('logout', 'Auth\LoginController@logout');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', 'HomeController@index')->name('home');
    Route::group(['middleware' => 'role:admin,staff'], function () {
        Route::group(['prefix' => 'management'], function () {
            Route::get('/user', 'Management\UserController@index')->name('management.index');
            Route::get('/dt-row-data', 'Management\UserController@getDtRowData');
            Route::get('/user/edit/{id}', 'Management\UserController@edit')->name('management.user.edit');
            Route::post('/user/edit/{id}', 'Management\UserController@update')->name('management.user.update');
            Route::get('/user/remove/{id}', 'Management\UserController@remove')->name('management.user.remove');
            Route::get('/user/create', 'Management\UserController@create')->name('management.user.create');
            Route::post('/user/store', 'Management\UserController@store')->name('management.user.store');
            Route::get('/user/{id}/assign', 'Management\UserController@assign')->name('management.user.assign');
            Route::post('/user/{id}/assign', 'Management\UserController@assignCourse')->name('management.user.assign');
            Route::get('/dt-row-data', 'Management\UserController@getDtRowData');
            Route::get('/user/{id}/assign', 'Management\UserController@assign')->name('management.user.assign');
            Route::post('/user/{id}/assign', 'Management\UserController@assignCourse')->name('management.user.assignCourse');
            Route::get('/user/{id}/{course}/remove', 'Management\UserController@removeAssignCourse')->name('management.course.remove');
            Route::get('/user/course/dt-row-data', 'Management\UserController@getCourseRowData');
        });
        
        Route::group(['prefix' => 'category'], function () {
            Route::get('', 'Management\CategoryController@index')->name('category.index');
            Route::get('/dt-row-data', 'Management\CategoryController@getDtRowData');
            Route::get('/create', 'Management\CategoryController@create')->name('category.create');
            Route::post('/store', 'Management\CategoryController@store')->name('category.store');
            Route::get('/remove/{id}', 'Management\CategoryController@remove')->name('category.remove');
            Route::get('/edit/{id}', 'Management\CategoryController@edit')->name('category.edit');
            Route::post('/edit/{id}', 'Management\CategoryController@update')->name('category.update');
            Route::get('/courses/{id}', 'Management\CategoryController@courses')->name('category.courses');
        });

        Route::group(['prefix' => 'course'], function () {
            Route::get('/', 'Management\CourseController@index')->name('course.index');
            Route::get('/dt-row-data', 'Management\CourseController@getDtRowData');
            Route::get('/create', 'Management\CourseController@create')->name('course.create');
            Route::post('/store', 'Management\CourseController@store')->name('course.store');
            Route::get('/remove/{id}', 'Management\CourseController@remove')->name('course.remove');
            Route::get('/edit/{id}', 'Management\CourseController@edit')->name('course.edit');
            Route::post('/edit/{id}', 'Management\CourseController@update')->name('course.update');
            Route::get('/view/{id}', 'Management\CourseController@viewUserinCourse')->name('course.viewUsers');
            Route::get('/user/{id}/{user}/remove', 'Management\CourseController@removeuserincourse')->name('course.remove.user');
            Route::get('/user-row-data', 'Management\CourseController@getUsersRowData');
        });
    });

    Route::group(['middleware' => 'role:admin,staff,trainee'], function () {
        Route::group(['prefix' => 'trainee'], function () {
            Route::get('/trainee-courses', 'Trainee\TraineeController@index')->name('trainee.trainee_course');
            Route::get('/dt-row-data', 'Trainee\TraineeController@getDtRowData');
            Route::get('/trainee_in_course/{id}', 'Trainee\TraineeController@trainee')->name('trainee.trainee_in_course');
            Route::get('/tnee-row-data', 'Trainee\TraineeController@getTneeRowData');
        });
    });

    Route::group(['middleware' => 'role:admin,staff,trainer'], function () {
        Route::group(['prefix' => 'trainer'], function () {
            Route::get('/trainer-courses', 'Trainer\TrainerController@index')->name('trainer.trainer_course');
            Route::get('/dt-row-data', 'Trainer\TrainerController@getDtRowData');
            Route::get('/trainer_in_course/{id}', 'Trainer\TrainerController@trainer')->name('trainer.trainer_in_course');
            Route::get('/tner-row-data', 'Trainer\TrainerController@getTnerRowData');
        });
    });
    
    Route::get('/profile', 'UserController@index')->name('profile');
    Route::post('/profile/edit', 'UserController@update')->name('profile.update');
});
