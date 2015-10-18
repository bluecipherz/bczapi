<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Project;
use App\Feed;
use App\Commands\CreateProject;
use App\Commands\CreateTask;
use App\Commands\UpdateTask;
use App\Commands\AddUserToProject;
use App\Commands\PostComment;
use App\Commands\PostStatus;

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

		$statusdetails = [
			'message' => 'hello wazzup?'
		];
		
		DB::table('projects')->delete();
		DB::table('users_projects')->delete();
		DB::table('tasks')->delete();
		
		// optional
		DB::table('feeds')->delete();
		DB::table('comments')->delete();
		DB::table('statuses')->delete();
		
		$user1 = User::firstOrFail();
		$user2 = User::all()->last();
		$project = Bus::dispatch(new CreateProject($user1, $projectdetails));
		$task = Bus::dispatch(new CreateTask($user1, $taskdetails, $project));
		Bus::dispatch(new AddUserToProject($user1, $project, $user2, 'developer'));
		Bus::dispatch(new UpdateTask($user2, $task, ['progress' => 100]));
		$task2 = Bus::dispatch(new CreateTask($user2, $taskdetails2, $project));
		// $feed = Feed::firstOrFail();
		// Bus::dispatch(new PostComment($user1, ['comment' => 'ookay'], $feed));
		// Bus::dispatch(new PostStatus($user1, null, $statusdetails));
	}

}
