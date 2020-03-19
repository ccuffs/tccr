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

// Project
Route::get('/project/create', 'ProjectController@create')->name('project.create');
Route::post('/project', 'ProjectController@store')->name('project.store');
Route::get('/project/{project}/edit', 'ProjectController@edit')->name('project.edit');
Route::get('/project/{project}', 'ProjectController@show')->name('project.show');
Route::patch('/project/{project}', 'ProjectController@update')->name('project.update');
Route::delete('/project/{project}', 'ProjectController@remove')->name('project.remove');

// Auth
Route::get('/login', 'Auth\LoginController@index')->name('login');
Route::post('/login', 'Auth\LoginController@auth');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

// Misc
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
    return view('welcome');
});
