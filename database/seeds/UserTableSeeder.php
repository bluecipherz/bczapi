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
		DB::table('portal_users');
		
		//~ $users = [
			//~ ['email' => 'asd@g.com', 'password' => Hash::make('asdasd'), 'userable_type' => 'App\PortalUser', 'userable_id' => 1],
			//~ ['email' => 'qwe@g.com', 'password' => Hash::make('asdasd'), 'userable_type' => 'App\PortalUser', 'userable_id' => 2],
			//~ ['email' => 'zxc@g.com', 'password' => Hash::make('asdasd'), 'userable_type' => 'App\PortalUser', 'userable_id' => 3],
			//~ ['email' => 'asd@y.com', 'password' => Hash::make('asdasd'), 'userable_type' => 'App\PortalUser', 'userable_id' => 4],
			//~ ['email' => 'qwe@y.com', 'password' => Hash::make('asdasd'), 'userable_type' => 'App\PortalUser', 'userable_id' => 5],
			//~ ['email' => 'zxc@y.com', 'password' => Hash::make('asdasd'), 'userable_type' => 'App\PortalUser', 'userable_id' => 6],
		//~ ];
		
		$user1 = App\User::create(['email' => 'asd@g.com', 'password' => Hash::make('asdasd')]);
		$user2 = App\User::create(['email' => 'qwe@g.com', 'password' => Hash::make('asdasd')]);
		$user3 = App\User::create(['email' => 'zxc@g.com', 'password' => Hash::make('asdasd')]);
		
		$portal1 = App\PortalUser::create([]);
		$portal2 = App\PortalUser::create([]);
		$portal3 = App\PortalUser::create([]);
		
		$portal1->user()->save($user1);
		$portal2->user()->save($user2);
		$portal3->user()->save($user3);
		
		
		//~ $portal_users = [
			//~ ['id' => 1],
			//~ ['id' => 2],
			//~ ['id' => 3],
			//~ ['id' => 4],
			//~ ['id' => 5],
			//~ ['id' => 6],
		//~ ];
		
		//~ DB::table('users')->insert($users);
		//~ DB::table('portal_users')->insert($portal_users);
		
		
	}

}
