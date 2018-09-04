<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function messages() {
        // con Message::class  indicamos que otro modelo tiene muchos de su ID, 1 USER has many MESSAGES
        return $this->hasMany(Message::class)->orderBy('created_at', 'desc');
	}
	

	public function follows() {
		// A belongsToMany, hay que indicarle, la clase, la tabla, la foreign key, la related key
		return $this->belongsToMany(User::class, 'followers', 'user_id', 'followed_id');
		// This way we are telling "give me from followers tables the users that I'm following"
	}


	public function followers() {
		// This way we are saying I'm been followed, tell me by whose
		return $this->belongsTomany(User::class, 'followers', 'followed_id', 'user_id');
	}


	public function isFollowing(User $user) {

		// With "contains" we are asking if this user follows the user indicated as parameter, this return true or false
		// In this case follows returns an array and we validate if that array "contains" the $user
		return $this->follows->contains($user);
	}


	public function socialProfiles() {

		return $this->hasMany(SocialProfile::class);
	}
}
