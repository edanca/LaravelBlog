<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
		$this->registerPolicies();

		// allows or not the user to perform this functionality
		// In this case dm is for Direct Message
        Gate::define('dms', function(User $user, User $other) {
			// This returns true if those users are follwing each other
			// dd($user);
			return
				$user->isFollowing($other) &&
				$other->isFollowing($user);
		});
    }
}
