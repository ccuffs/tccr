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
Route::get('/project/start', 'ProjectController@start')->name('project-start');
Route::get('/project/{project}', 'ProjectController@view')->name('project-view');
Route::get('/project/{project}/edit', 'ProjectController@edit')->name('project-edit');

// Auth
Route::get('/login', 'Auth\LoginController@index')->name('login');
Route::post('/login', 'Auth\LoginController@auth');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

// Misc
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
    return view('welcome');
});
