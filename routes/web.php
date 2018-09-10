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

Auth::routes();

// With this route, we redirect the user to login with facebook
Route::get('/auth/facebook', 'SocialAuthController@facebook');

// Receive data from Facebook User logged
Route::get('/auth/facebook/callback', 'SocialAuthController@callback');

Route::post('/auth/facebook/register', 'SocialAuthController@register');

// To perofmr the search using the search in navbar
Route::get('/messages', 'MessagesController@search');

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/{username}', 'UsersController@show');

// Shows all the Users that the User follows
Route::get('/{username}/follows', 'UsersController@follows');

// Shows the followers that a the User has
Route::get('/{username}/followers', 'UsersController@followers');

Route::group(['middleware' => 'auth'], function() {

	Route::post('/{username}/dms', 'UsersController@sendPrivateMessage');
	Route::post('/messages/create', 'MessagesController@create'); //->middleware('auth');

	// Make follow a User
	Route::post('/{username}/follow', 'UsersController@follow');

	// Make unfolloww a User
	Route::post('/{username}/unfollow', 'UsersController@unfollow');

	// TODO: crear controlador para conversaciones
	Route::get('/conversations/{conversation}', 'UsersController@showConversation');
});
