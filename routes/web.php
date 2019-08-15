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

Route::get('/p/create', 'PostsController@create'); //the routes are created following https://laravel.com/docs/5.1/controllers#restful-resource-controllers
Route::post('/p', 'PostsController@store');


Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');
