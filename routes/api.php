<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('application/{id}', 'ApiController@application')->name('api-application');
Route::post('status_ass/', 'ApiController@statusAss')->name('api-status_ass');
Route::post('status_user/', 'ApiController@statusUser')->name('api-status_user');
Route::post('status_assignment/', 'ApiController@statusAssignment')->name('api-status_assignment');;
