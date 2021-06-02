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

    
    Route::get('schedule_activities', 'ScheduleActivityController@index')->name("schedule_activities.index");
    Route::get('schedule_activities/create', 'ScheduleActivityController@create')->name("schedule_activities.create");
    Route::post('schedule_activities/store', 'ScheduleActivityController@store')->name("schedule_activities.store");
    Route::put('schedule_activities/update/{id}', 'ScheduleActivityController@update')->name("schedule_activities.update");
    Route::post('schedule_activities/delete/{id}', 'ScheduleActivityController@delete')->name("schedule_activities.delete");
    Route::get('schedule_activities/{id}/edit', 'ScheduleActivityController@edit')->name("schedule_activities.edit");
    Route::get('schedule_activities/{id}','PriorityController@show')->name("schedule_activities");
    Route::get('schedule_activities/show/{id}','ScheduleActivityController@show')->name("schedule_activities.show");

    Route::get('priorities/{id}/edit', 'ScheduleActivityController@edit')->name("schedule_activities.edit");
    Route::get('priorities/show/{id}', 'ScheduleActivityController@show')
    ;

    Route::get('schedule-activity/delete/{photo_id}/{id}', 'ScheduleActivityController@deleteGallery')->name('schedule-activity-delete');
    Route::resource('priorities','PriorityController');
    Route::resource('new_assignments','NewAssignmentController');
     
    Route::post('new_assignments/email', 'NewAssignmentController@postEmail')->name('new_assignments-email');
    Route::get('new_assignments/delete/{photo_id}/{id}', 'NewAssignmentController@deleteGallery')
    ->name('new_assignments-delete');
    Route::get('ViewPages', 'ReportUserController@index');
    Route::post('ViewPages', 'ReportUserController@index');
});