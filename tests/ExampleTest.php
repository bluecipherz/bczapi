<?php

use App\Commands\CreateProject;
use App\User;
use App\Project;
use App\Feed;

class ExampleTest extends TestCase {


	public function setUp() {
		parent::setUp();
		DB::table('projects')->delete();
		DB::table('feeds')->delete();
	}
	
	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testCreateProjects()
	{
		$data = [
			'name' => 'asd',
			'description' => 'qweqwe',
		];
		Bus::dispatch(new CreateProject(User::findOrFail(1), $data));
		$this->assertEquals(1, Project::all()->count());
		$this->assertEquals(1, Feed::all()->count());
		// Event::fire(new App\Events\TestEvent());
	}

}
