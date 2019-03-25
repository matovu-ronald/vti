<?php

use Illuminate\Http\Request;

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

// Imports
Route::post('import/service/providers', 'Admin\ImportServiceProviderController@store')->name('import.store');
Route::post('import/courses', 'Admin\ImportCourseController@store')->name('courses.store');
