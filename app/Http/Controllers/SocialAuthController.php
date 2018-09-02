<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\User;
use App\SocialProfile;

class SocialAuthController extends Controller
{
	//
	public function facebook() {
		// redirect to Facebook's login
		return Socialite::driver('facebook')->redirect();
	}


	public function callback() {
		// Get the User that facebook returns
		$user = Socialite::driver('facebook')->user();

		// Validate if the user given is already registered
		$existing = User::whereHas('socialProfiles', function($query) use ($user) {
			// The social profiel that I've found has to have its socialId equals to the user->id received from Facebook
			$query->where('social_id', $user->id);
		})->first();

		if ($existing != null) {
			// login the user
			auth()->login($existing);
			return redirect('/');
		}

		// dd($user);
		session()->flash('facebookUser', $user);

		return view('users.facebook', [
			'user' => $user,
		]);
	}


	public function register(Request $request) {
		
		// We receive data from Facebook
		$data = session('facebookUser');

		$username = $request->input('username');
	
		// Create User
		$user = User::create([
			'name' => $data->name,
			'email' => $data->email,
			'avatar' => $data->avatar,
			'username' => $username,
			'password' => str_random(16)
		]);

		$profile = SocialProfile::create([
			'social_id' => $data->id,
			'user_id' => $user->id,
		]);

		auth()->login($user);

		return redirect('/');
	}
}
