<?php

namespace App\Http\Controllers;

use App\User;
use App\Message;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    
    public function show($username) {
		// To see a User with its created messages

		$user = $this->findByUserName($username);
		// $messages = $user->messages; // This bring us all the messages for that user
		$messages = Message::where('user_id', $user->id)->paginate(4); // This bring all the messages and create a Pagination
        
        return view('users.show', [
			'user' => $user,
			'messages' => $messages,
        ]);
	}
	
	
	public function follow($username, Request $request) {
		// Current User follows another User
		// We access to Request since this is called by a POST method

		$user = $this->findByUserName($username);

		// User already logged-in gived by the Request, this user() is Model
		$me = $request->user();

		$me->follows()->attach($user);

		return redirect("/$username")->withSuccess('Usuario Seguido!');
	}


	public function follows($username) {
		// To see which users is following the indicated User

		// TODO: to fix created_at and updated_at which is saving as NULL
		$user = $this->findByUserName($username);

		return view('users.follows', [
			'user' => $user,
			'follows' => $user->follows,
		]);
	}


	private function findByUserName($username) {
		// To find a User
		return User::where('username', $username)->first();
	}


	public function unfollow($username, Request $request) {
		// Current User follows another User
		// We access to Request since this is called by a POST method

		$user = $this->findByUserName($username);

		// User already logged-in gived by the Request, this user() is Model
		$me = $request->user();

		$me->follows()->detach($user);

		return redirect("/$username")->withSuccess('Usuario no seguido!');
	}


	public function followers($username) {

		$user = $this->findByUserName($username);

		return view('users.follows', [
			'user' => $user,
			'follows' => $user->followers,
		]);
	}
}
