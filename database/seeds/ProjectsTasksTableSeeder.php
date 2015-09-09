<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Project;
use App\Commands\CreateProject;
use App\Commands\CreateTask;
use App\Commands\UpdateTask;
use App\Commands\AddUserToProject;

class ProjectsTasksTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		
		$projectdetails = [
			'name' => 'shitzu',
			'description' => 'frickzena oah auhsdoh vgos'
		];
		
		$taskdetails = [
			'name' => 'joozie',
			'description' => 'ahioihd poaiy7u ascihogyfcd pouaou'
		];
		
		$taskdetails2 = [
			'name' => 'ambroze',
			'description' => 'shitzu prickzen la frickzen'
		];
		
		DB::table('projects')->delete();
		DB::table('users_projects')->delete();
		DB::table('tasks')->delete();
		
		// optional
		DB::table('feeds')->delete();
		
		$user1 = User::firstOrFail();
		$user2 = User::all()->last();
		$project = Bus::dispatch(new CreateProject($user1, $projectdetails));
		$task = Bus::dispatch(new CreateTask($user1, $project, $taskdetails));
		Bus::dispatch(new AddUserToProject($user1, $project, $user2, 'developer'));
		Bus::dispatch(new UpdateTask($user2, $task, ['percentage_completed' => 100]));
		$task2 = Bus::dispatch(new CreateTask($user2, $project, $taskdetails2));
	}

}
