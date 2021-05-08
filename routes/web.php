<?php

use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Auth::routes();
   
Route::post('/login', 'Auth\LoginController@check_login')->name('login.check_login');
Route::get('/postforgot', 'Auth\ForgotPasswordController@postforgot')->name('postforgot');
Route::group(['middleware' => ['auth']], function() {
    Route::get('/', 'HomeController@index')->name('dashboards');
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
    Route::resource('forums','ForumController');
    Route::resource('projects','ProjectController');
    Route::resource('applications','ApplicationController');
    Route::resource('schedule_activities','ScheduleActivityController');
    Route::get('schedule_activities/delete/{photo_id}/{id}', 'ScheduleActivityController@deleteGallery')->name('schedule_activities-delete');
    Route::resource('priorities','PriorityController');
    Route::resource('new_assignments','NewAssignmentController');
    Route::post('new_assignments/email', 'NewAssignmentController@postEmail')->name('new_assignments-email');
    Route::get('new_assignments/delete/{photo_id}/{id}', 'NewAssignmentController@deleteGallery')
    ->name('new_assignments-delete');
    Route::get('ViewPages', 'ReportUserController@index');
    Route::post('ViewPages', 'ReportUserController@index');
});