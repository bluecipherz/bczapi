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
		
		$users = [
			['id' => 1, 'email' => 'asd@g.com', 'password' => Hash::make('asdasd'), 'userable_type' => 'App\PortalUser', 'userable_id' => 1],
			['id' => 2, 'email' => 'qwe@g.com', 'password' => Hash::make('asdasd'), 'userable_type' => 'App\PortalUser', 'userable_id' => 2],
			['id' => 3, 'email' => 'zxc@g.com', 'password' => Hash::make('asdasd'), 'userable_type' => 'App\PortalUser', 'userable_id' => 3],
			['id' => 4, 'email' => 'asd@y.com', 'password' => Hash::make('asdasd'), 'userable_type' => 'App\PortalUser', 'userable_id' => 4],
			['id' => 5, 'email' => 'qwe@y.com', 'password' => Hash::make('asdasd'), 'userable_type' => 'App\PortalUser', 'userable_id' => 5],
			['id' => 6, 'email' => 'zxc@y.com', 'password' => Hash::make('asdasd'), 'userable_type' => 'App\PortalUser', 'userable_id' => 6],
		];
		
		$portal_users = [
			['id' => 1],
			['id' => 2],
			['id' => 3],
			['id' => 4],
			['id' => 5],
			['id' => 6],
		];
		
		DB::table('users')->insert($users);
		DB::table('portal_users')->insert($portal_users);
		
		
	}

}
