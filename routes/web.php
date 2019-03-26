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
    return redirect('/vocational-training-institute');
});

// Imports
Route::prefix('api')->group(function () {
    Route::post('import/service/providers', 'Admin\ImportServiceProviderController@store')->name('import.store');
    Route::post('import/courses', 'Admin\ImportCourseController@store')->name('courses.store');
});

/* CATCH-ALL ROUTE for Backpack/PageManager - needs to be at the end of your routes.php file  **/
Route::get('{page}/{subs?}', ['uses' => 'PageController@index'])
    ->where(['page' => '^((?!admin).)*$', 'subs' => '.*']);
