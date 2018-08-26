<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
		// Before, create message only
		/*factory(App\Message::class)
			->times(100)
			->create();*/

        // Function creates 50 users and for each user creates 20 messages
        /*factory(App\User::class, 50)->create()->each(function(App\User $user) {
            factory(App\Message::class)
        	->times(20)
        	->create([
                'user_id' => $user->id
            ]);
		});*/
		

		// Con "use" estamos dando acceso a la variable externa $users que no està definida dentro del scope de la función each
		$users = factory(App\User::class, 50)->create();
		$users->each(function(App\User $user) use ($users) {
            factory(App\Message::class)
        	->times(20)
        	->create([
                'user_id' => $user->id
			]);
			
			// De esta manera al resultado $user de la anterior operación, le hacemos seguir a 10 usuarios al azar
			$user->follows()->sync(
				$users->random(10)
			);
		});
		
    }
}
