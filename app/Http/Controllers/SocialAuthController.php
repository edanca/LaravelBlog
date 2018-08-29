<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;

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

		dd($user);
	}
}
