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
		DB::table('portal_users')->delete();
		
		$user1 = App\User::create(['email' => 'asd@g.com', 'password' => Hash::make('asdasd'), 'first_name' => 'Shaji', 'last_name' => 'Periya', 'privilege_level' => 1]);
		$user2 = App\User::create(['email' => 'qwe@g.com', 'password' => Hash::make('asdasd'), 'first_name' => 'Koyi', 'last_name' => 'Moideen']);
		$user3 = App\User::create(['email' => 'zxc@g.com', 'password' => Hash::make('asdasd'), 'first_name' => 'Ambrose', 'last_name' => 'Warma',]);
		
		$portal1 = App\PortalUser::create([]);
		$portal2 = App\PortalUser::create([]);
		$portal3 = App\PortalUser::create([]);
		
		$portal1->user()->save($user1);
		$portal2->user()->save($user2);
		$portal3->user()->save($user3);
		
	}

}
