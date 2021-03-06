<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'api/v1'], function () {
	Route::get('employees/{id}/jobs', 'JobsController@index');
	Route::resource('employees', 'EmployeesController');
	Route::resource('jobs', 'JobsController', ['only' => ['show', 'index']]);
});