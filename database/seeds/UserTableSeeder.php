<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('users')->delete();
		
		$user1 = App\User::create(['email' => 'asd@g.com', 'password' => Hash::make('asdasd'), 'privilege_level' => 1]);
		$user2 = App\User::create(['email' => 'qwe@g.com', 'password' => Hash::make('asdasd')]);
		$user3 = App\User::create(['email' => 'zxc@g.com', 'password' => Hash::make('asdasd')]);

		$user1->profile()->create(['avatar_url' => '/images/profiles/1/avatar.png', 'first_name' => 'Shaji', 'last_name' => 'Periya']);
		$user2->profile()->create(['avatar_url' => '/images/profiles/2/avatar.jpg', 'first_name' => 'Koyi', 'last_name' => 'Moideen']);
		$user3->profile()->create(['avatar_url' => '/images/profiles/3/avatar.gif', 'first_name' => 'Ambrose', 'last_name' => 'Warma']);
		
	}

}
