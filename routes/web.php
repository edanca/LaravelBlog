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

Route::get('/', 'PagesController@home');

Route::get('/messages/{message}', 'MessagesController@show');

Route::post('/messages/create', 'MessagesController@create')->middleware('auth');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/{username}', 'UsersController@show');

// Shows all the Users that the User follows
Route::get('/{username}/follows', 'UsersController@follows');

// Make follow a User
Route::post('/{username}/follow', 'UsersController@follow');

// Make unfolloww a User
Route::post('/{username}/unfollow', 'UsersController@unfollow');

// Shows the followers that a the User has
Route::get('/{username}/followers', 'UsersController@followers');