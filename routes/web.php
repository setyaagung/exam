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

Auth::routes(['verify' => true]);

Route::middleware(['auth'])->group(function () {
    //siswa
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/join_exam', 'HomeController@join_exam')->name('join_exam');
});

Route::middleware(['auth', 'isAdmin'])->group(function () {
    //admin
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('group', 'GroupController');
    Route::resource('course', 'CourseController');
    Route::resource('exam', 'ExamController');
    Route::get('/update-status/{id}', 'ExamController@update_status');
    Route::get('/exam/{slug}/question', 'ExamController@question')->name('question');
    Route::get('/exam/{slug}/question/create_question', 'ExamController@create_question')->name('create_question');
    Route::post('/exam/question/store_question', 'ExamController@store_question')->name('store_question');
    Route::resource('student', 'StudentController');
    Route::resource('user', 'UserController');
});
