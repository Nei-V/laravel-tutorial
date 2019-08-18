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
/* 
Route::get('/', function () {
    return view('welcome');
}); */



Auth::routes();
//the routes order is important - if you out the rout /p/{post} before /p/create, it will never reach /p/create, because /p/{post} is more general (contains a variable)

//this is how we can test a route:
/* Route::post('follow/{user}', function() {
    return ['success'];
}) */;
Route::post('follow/{user}', 'FollowsController@store');

Route::get('/','PostsController@index');//we want the homepage to bring all the latest posts from all users
Route::get('/p/create', 'PostsController@create'); //the routes are created following https://laravel.com/docs/5.1/controllers#restful-resource-controllers
Route::post('/p', 'PostsController@store');
Route::get('/p/{post}','PostsController@show');


Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');
Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');//this show the edit profile page
Route::patch('/profile/{user}', 'ProfilesController@update')->name('profile.update'); //this does the actual action of updating
