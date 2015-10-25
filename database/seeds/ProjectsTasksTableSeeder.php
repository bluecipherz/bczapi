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
		DB::table('stories')->delete();
		DB::table('sprints')->delete();
		DB::table('backlogs')->delete();
		
		// optional
		DB::table('feeds')->delete();
		DB::table('comments')->delete();
		DB::table('statuses')->delete();
		
		$user1 = User::firstOrFail();
		$user2 = User::all()->last();
		$project = Bus::dispatch(new CreateProject($user1, $projectdetails));
		Bus::dispatch(new AddUserToProject($user1, $project, $user2, 'developer'));
		$users = User::whereIn('id', [$user1->id, $user2->id])->get();
		// $task = Bus::dispatch(new CreateTask($user1, $taskdetails, $project, null, $users));
		// Bus::dispatch(new UpdateTask($user2, $task, ['progress' => 100]));

		$backlog = App\Backlog::create(['name' => 'Release Elixir']);
		$user1->backlogs()->save($backlog);
		$project->backlogs()->save($backlog);

		$sprint = App\Sprint::create(['name' => 'Sprint Shikku']);
		$project->sprints()->save($sprint);
		$backlog->sprints()->save($sprint);
		$user1->sprints()->save($sprint);

		$datas = [
	        [ 'name'=>'Refactoring Iceblocks','description'=>'Cool tasks are always cool. So do this !!','priority'=>1,'work_hours'=>'7'], 
	        [ 'name'=>'Streaming section','description'=>'This is one of the besttask ever i ve seen in my life time => )','priority'=>0,'work_hours'=>'2'], 
	        [ 'name'=>'Urgent Completion','description'=>'This is a urgent task . U should make the system flow for ever','priority'=>3,'work_hours'=>'8'], 
	        [ 'name'=>'Elangent Model shift','description'=>'Super awesome task you will love it i know ...!!','priority'=>2,'work_hours'=>'5'], 
	        [ 'name'=>'Bug trakking system','description'=>'This task is for powerful people.. Yeah you..! ','priority'=>1,'work_hours'=>'2'], 
	        [ 'name'=>'Featured blog completion','description'=>'This is a urgent task . U should make the system flow for ever','priority'=>3,'work_hours'=>'6'], 
	        [ 'name'=>'Quick finish','description'=>'Super awesome task you will love it i know it, can you just finish this.. ? sothat we can move On..','priority'=>0,'work_hours'=>'7'], 
	        [ 'name'=>'Trapped module refactoring','description'=>'Super awesome task you will love it i know ...!!','priority'=>3,'work_hours'=>'2'], 
	        [ 'name'=>'Smooth UI Design','description'=>'This is a urgent task . U should make the system flow for ever','priority'=>2,'work_hours'=>'4'], 
	        [ 'name'=>'Refactoring Iceblocks','description'=>'Major refactor needed in the sublimentory section of zylanfuzku Masked version.Its all about the stuffs and stone of the rechard steven.','priority'=>0,'work_hours'=>'7'], 
	        [ 'name'=>'Urgent Completion','description'=>'This is a urgent task . U should make the system flow for ever','priority'=>3,'work_hours'=>'8'], 
	        [ 'name'=>'Elangent Model shift','description'=>'Super awesome task you will love it i know ...!!','priority'=>2,'work_hours'=>'5'], 
	        [ 'name'=>'Bug trakking system','description'=>'This task is for powerful people.. Yeah you..! ','priority'=>1,'work_hours'=>'2'], 
	        [ 'name'=>'Featured blog completion','description'=>'This is a urgent task . U should make the system flow for ever','priority'=>3,'work_hours'=>'6'], 
	        [ 'name'=>'Quick finish','description'=>'Super awesome task you will love it i know it, can you just finish this.. ? sothat we can move On..','priority'=>0,'work_hours'=>'7'], 
	        [ 'name'=>'Trapped module refactoring','description'=>'Super awesome task you will love it i know ...!!','priority'=>3,'work_hours'=>'2'], 
	        [ 'name'=>'Quick finish','description'=>'Super awesome task you will love it i know it, can you just finish this.. ? sothat we can move On..','priority'=>0,'work_hours'=>'7'], 
	        [ 'name'=>'Trapped module refactoring','description'=>'Super awesome task you will love it i know ...!!','priority'=>3,'work_hours'=>'2'], 
	        [ 'name'=>'Smooth UI Design','description'=>'This is a urgent task . U should make the system flow for ever','priority'=>2,'work_hours'=>'4'], 
	        [ 'name'=>'Refactoring Iceblocks','description'=>'Major refactor needed in the sublimentory section of zylanfuzku Masked version.Its all about the stuffs and stone of the rechard steven.','priority'=>0,'work_hours'=>'7'], 
	        [ 'name'=>'Urgent Completion','description'=>'This is a urgent task . U should make the system flow for ever','priority'=>3,'work_hours'=>'8'], 
	        [ 'name'=>'Elangent Model shift','description'=>'Super awesome task you will love it i know ...!!','priority'=>2,'work_hours'=>'5'], 
	        [ 'name'=>'Bug trakking system','description'=>'This task is for powerful people.. Yeah you..! ','priority'=>1,'work_hours'=>'2'], 
	        [ 'name'=>'Featured blog completion','description'=>'This is a urgent task . U should make the system flow for ever','priority'=>3,'work_hours'=>'6'], 
	        [ 'name'=>'Quick finish','description'=>'Super awesome task you will love it i know it, can you just finish this.. ? sothat we can move On..','priority'=>0,'work_hours'=>'7'], 
	        [ 'name'=>'Trapped module refactoring','description'=>'Super awesome task you will love it i know ...!!','priority'=>3,'work_hours'=>'2'], 
	        [ 'name'=>'Quick finish','description'=>'Super awesome task you will love it i know it, can you just finish this.. ? sothat we can move On..','priority'=>0,'work_hours'=>'7'], 
	        [ 'name'=>'Trapped module refactoring','description'=>'Super awesome task you will love it i know ...!!','priority'=>3,'work_hours'=>'2'], 
      	];

      	foreach($datas as $data) {
      		$story = App\Story::create($data);
      		$project->stories()->save($story);
      		$user1->createdStories()->save($story);
      	}
		// $task2 = Bus::dispatch(new CreateTask($user2, $taskdetails2, $project));
		// $feed = Feed::firstOrFail();
		// Bus::dispatch(new PostComment($user1, ['comment' => 'ookay'], $feed));
		// Bus::dispatch(new PostStatus($user1, null, $statusdetails));
	}

}
