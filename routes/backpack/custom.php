<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', config('backpack.base.middleware_key', 'admin')],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    CRUD::resource('business', 'BusinessCrudController');
    CRUD::resource('vti', 'VtiCrudController');
    CRUD::resource('course', 'CourseCrudController');
    CRUD::resource('bioprofile', 'BioProfileCrudController');
    Route::get('import/service/providers', 'ImportServiceProviderController@create')->name('import.create');
    Route::get('import/courses/', 'ImportCourseController@create')->name('course.create');
}); // this should be the absolute last line of this file
