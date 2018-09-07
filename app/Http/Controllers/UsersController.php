<?php

namespace App\Http\Controllers;

use App\User;
use App\Message;
use App\Conversation;
use App\PrivateMessage;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    
    public function show($username) {
		// To see a User with its created messages

		throw new \Exeption("Simulando un error.");
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


	public function sendPrivateMessage($username, Request $request) {

		$user = $this->findByUserName($username);

		// Get the user model from request
		$me = $request->user();
		$message = $request->input('message');

		$conversation = Conversation::between($me, $user);

		// This way, we use Conversation Model function to add a User to the conversation
		// $conversation = Conversation::create();
		// $conversation->users()->attach($me);
		// $conversation->users()->attach($user);

		// Create Private Message from current user to the intended user
		$privateMessage = PrivateMessage::create([
			'conversation_id' => $conversation->id,
			'user_id' => $me->id,
			'message' => $message,
		]);

		return redirect('/conversations/'. $conversation->id);
	}


	public function showConversation(Conversation $conversation) {
		
		$conversation->load('users', 'privateMessages');
		
		return view('users.conversation', [
			'conversation' => $conversation,
			'user' => auth()->user(), // logged user
		]);
	}

	// PRIVATE FUNCTIONS -----------------------------------------------------------------------

	private function findByUserName($username) {
		// To find a User
		// return User::where('username', $username)->first();
		// Use firstOrFail in case no user was found throw an exception by failing and this calls our 404 view
		return User::where('username', $username)->firstOrFail();
	}
}
