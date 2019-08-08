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

Route::group([
    'prefix' => 'adminka',
    'namespace' => 'Admin',
    'as' => 'admin.',
    'middleware' => ['auth', 'admin']
], function () {
    Route::get('', 'AdminController@index')->name('index');
    Route::resource('cities', 'CityController');
    Route::resource('projects', 'ProjectController');
    Route::resource('settings', 'SettingsController');
    Route::resource('activitylogs', 'ActivityLogsController')->only([
        'index', 'show', 'destroy'
    ]);

});
