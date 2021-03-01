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
    Route::get('/ujian', 'SiteExamController@exam')->name('exam');
    Route::get('/ujian/{slug}/konfirmasi-data', 'SiteExamController@confirm_data')->name('confirm_data');
    Route::get('/ujian/{slug}/join', 'SiteExamController@join_exam')->name('join_exam');
    Route::post('/ujian/join/submit_exam', 'SiteExamController@submit_exam')->name('submit_exam');
    Route::get('/ujian{slug}/show_result/{id}', 'SiteExamController@show_result')->name('show_result');
});

Route::middleware(['auth', 'isAdmin'])->group(function () {
    //admin & guru
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('group', 'GroupController');
    Route::resource('course', 'CourseController');
    Route::resource('exam', 'ExamController');
    Route::get('/update-status/{id}', 'ExamController@update_status');
    Route::get('/exam/{slug}/question', 'ExamController@question')->name('question');
    Route::get('/exam/{slug}/question/create_question', 'ExamController@create_question')->name('create_question');
    Route::post('/exam/question/store_question', 'ExamController@store_question')->name('store_question');
    Route::get('/exam/{slug}/question/{id}/edit_question', 'ExamController@edit_question')->name('edit_question');
    Route::patch('/exam/{slug}/question/{id}', 'ExamController@update_question')->name('update_question');
    Route::delete('/exam/{slug}/question/{id}', 'ExamController@destroy_question')->name('destroy_question');
    Route::resource('teacher', 'TeacherController');
    Route::resource('student', 'StudentController');
    Route::resource('user', 'UserController');
});
