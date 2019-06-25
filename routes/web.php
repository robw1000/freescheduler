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

//Route::resource('staff','StaffController');

//php artisan make:controller StaffController -r

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/staff', 'StaffController@index')->name('staffhome');

Route::get('/staff/create', 'StaffController@create');

Route::post('/staff', 'StaffController@store');

Route::get('/staff/{id}/delete', 'StaffController@destroy');


Route::get('/client', 'ClientController@index')->name('staffhome');

Route::get('/client/create', 'ClientController@create');

Route::post('/client', 'ClientController@store');

Route::get('/client/{id}/delete', 'ClientController@destroy');


Route::get('/schedule/{cid}/', 'ScheduleController@index');

Route::get('/schedule/{cid}/create', 'ScheduleController@create');

Route::post('/schedule', 'ScheduleController@store');

Route::get('/schedule/{id}/delete', 'ScheduleController@destroy');

Route::get('/calendar', 'ScheduleController@calendar');

Route::get('/resources', 'ScheduleController@resources');