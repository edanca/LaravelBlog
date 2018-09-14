<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use DB;

class UsersTest extends TestCase
{
	public function testCanSeeUserPage()
	{
		// DB::transaction(function () {
		try {
			DB::beginTransaction();
			$user = factory(User::class)->create();		
			$response = $this->get($user->username);
			$response->assertSee($user->name);
			// DB::commit();
			DB::rollBack();
		} catch (execption $e) {
			DB::rollBack();
		}		
		// });
	}


	public function testCanLogin()
	{
		DB::transaction(function () {
			// $user = User::find(1);
			$user = factory(User::class)->create();
	
			// dd($user->email);
	
			$response = $this->post('/login', [
				'email' => $user->email,
				'password' => 'secret',
			]);
	
			// $this->assertAuthenticated();
			$this->assertAuthenticatedAs($user);
			
			DB::rollback();
		});
	}


	public function testCanFollow()
	{
		DB::transaction(function () {
			$user = factory(User::class)->create();
			$other = factory(User::class)->create();
			
			// actingAs logs the user
			$response = $this->actingAs($user)->post($other->username.'/follow');

			$this->assertDatabaseHas('followers', [
				'user_id' => $user->id,
				'followed_id' => $other->id,
			]);

			DB::rollback();
		});
	}
}
