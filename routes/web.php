<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::resource('group', 'GroupController');
    Route::resource('course', 'CourseController');
    Route::resource('exam', 'ExamController');
    Route::get('/update-status/{id}', 'ExamController@update_status');
});
