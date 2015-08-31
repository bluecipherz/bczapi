<?php

use App\Commands\CreateProject;
use App\Commands\CreateTask;
use App\Commands\CompleteTask;
use App\Commands\UpdateStatus;
use App\Commands\PostForum;
use App\Commands\PostComment;
use App\Commands\AddUserToProject;
use App\Commands\CreateChatRoom;
use App\User;
use App\Project;
use App\Feed;
use App\Task;
use App\Comment;
use App\Status;
use App\Forum;
use App\Chat;
use App\Events\ProjectCreated;
use App\Events\TaskCreated;
use App\Events\TaskCompleted;
use App\Events\StatusUpdated;
use App\Events\ForumPosted;
use App\Events\CommentPosted;
use App\Events\UserAddedToProject;
use App\Events\ChatRoomCreated;

class ModelsTest extends TestCase {
	
	private $project, $user;
	
	
	private $projectdata = [
		'name' => 'asd',
		'description' => 'qweqwe',
	];
	
	private $taskdata = [
		'name' => 'xcoivujos',
		'description' => 'oiurwe'
	];
	
	private $commentdata = [
		'comment' => 'shitzu'
	];
	
	private $messagedata = [
		'message' => 'fuckzem'
	];
	
	
	public function setUp() {
		parent::setUp();
        //~ Artisan::call('migrate:refresh'); // slower
        Artisan::call('migrate');
		$this->seed(); // comment this to make even faster
		// currently there are no seed files for some tables so they have to be manually cleaned
		DB::table('projects')->delete();
		DB::table('feeds')->delete();
		DB::table('tasks')->delete();
		//~ DB::table('comments')->delete();
		DB::table('statuses')->delete();
	}
	
	/**
	 *  EVENTS TESTS
	 */
	 
	public function testProjectCreated()
	{
		$project = Project::create($this->projectdata);
		$user = User::firstOrFail();
		$user->userable->ownProjects()->save($project);
		event(new ProjectCreated($user, $project));
		$this->assertEquals(1, Project::all()->count());
		$this->assertEquals('App\Events\ProjectCreated', $project->feed->type);
		$this->assertEquals(1, $user->userable->ownProjects()->count());
		$this->assertEquals($project->id, $project->feed->feedable_id);
		$this->assertEquals('App\Project', $project->feed->feedable_type);
		$this->assertEquals(0, $project->feed->project_id);
	}
	
	public function testTasksCreated() {
		$project = Project::firstOrCreate($this->projectdata);
		$task = Task::create($this->taskdata);
		$project->tasks()->save($task);
		$user = User::firstOrFail();
		$task->owner()->associate($user);
		event(new TaskCreated($user, $project, $task));
		$this->assertEquals(1, Task::count());
		$this->assertEquals('App\Events\TaskCreated', $task->feed->type);
		$this->assertEquals($task->project->id, $task->feed->project_id);
		
		$this->assertEquals(0, $task->comments->count());
		$comment = Comment::create($this->commentdata);
		$task->comments()->save($comment);
		$this->assertEquals(1, $task->comments()->count());
	}
	
	public function testTaskCompleted() {
		$task = Task::create($this->taskdata);
		$user = User::firstOrFail();
		$project = Project::create($this->projectdata);
		event(new TaskCompleted($user, $project, $task));
		$this->assertEquals(1, Feed::count());
		$this->assertEquals($task->id, Feed::firstOrFail()->feedable->id);
		$this->assertEquals($project->id, Feed::firstOrFail()->project_id);
		$this->assertEquals('App\Events\TaskCompleted', $task->feed->type);
	}
	
	public function testStatusUpdate() {
		$status = Status::create($this->messagedata);
		$user = User::firstOrFail();
		$status->owner()->associate($user);
		event(new StatusUpdated($user, $status));
		$this->assertEquals(1, Feed::count());
		$this->assertEquals(StatusUpdated::class, $status->feed->type);
		$this->assertEquals(0, Feed::firstOrFail()->project_id);
		$this->assertEquals('App\Events\StatusUpdated', $status->feed->type);
	}
	
	public function testProjectStatusUpdate() {
		$status = Status::create($this->messagedata);
		$user = User::firstOrFail();
		$status->owner()->associate($user);
		$project = Project::create($this->projectdata);
		event(new StatusUpdated($user, $status, $project));
		$this->assertEquals(1, Feed::count());
		$this->assertEquals(StatusUpdated::class, $status->feed->type);
		$this->assertEquals($project->id, Feed::firstOrFail()->project_id);
		$this->assertEquals('App\Events\StatusUpdated', $status->feed->type);
	}
	
	public function testForumPosted() {
		$project = Project::create($this->projectdata);
		$user = User::firstOrFail();
		$forum = Forum::create([
			'name' => 'sjihisdf',
			'description' => 'dosifhbdof'
		]);
		//~ $user->forums()->save($forum);
		$forum->owner()->associate($user);
		$project->forums()->save($forum);
		event(new ForumPosted($user, $project, $forum));
		$this->assertEquals(1, $user->forums->count());
		$this->assertEquals(1, $project->forums->count());
		$this->assertEquals($user->id, $forum->owner->id);
		$this->assertEquals($project->id, $forum->project->id);
		$this->assertEquals(1, Feed::count());
		$this->assertEquals($forum->id, Feed::firstOrFail()->feedable->id);
		$this->assertEquals($project->id, Feed::firstOrFail()->project_id);
		$this->assertEquals('App\Events\ForumPosted', $forum->feed->type);
	}
	
	public function testUserAddedToProject() {
		$owner = User::firstOrFail();
		$user = User::all()->last();
		$this->assertNotNull($user);
		$this->assertNotEquals($owner->id, $user->id);
		$project = Project::create($this->projectdata);
		$project->owner()->associate($owner); // link
		$this->assertEquals($project->owner->id, $owner->id);
		$project->users()->save($user); // link
		$this->assertEquals(1, $project->users->count());
		$this->assertTrue($project->users->contains($user->id));
		event(new UserAddedToProject($owner, $project, $user));
		$this->assertEquals(1, Feed::count());
		$this->assertEquals($project->id, Feed::firstOrFail()->project_id);
		$this->assertEquals($user->id, Feed::firstOrFail()->feedable->id);
		$this->assertEquals('App\Events\UserAddedToProject', $user->feed->type);
	}
	
	public function testChatRoomCreated() {
		$chat = Chat::create();
	}
	
	
	/**
	 * COMMENTS TESTS
	 */
	 
	public function testProjectCreatedCommentPosted() {
		$comment = Comment::create($this->commentdata);
		$user = User::firstOrFail();
		$project = Project::create($this->projectdata);
		//~ $comment->owner()->associate($user);
		//~ $comment->owner()->save($user);
		$user->comments()->save($comment);
		$comment->commentable()->associate($project);
		event(new CommentPosted($user, $comment, $project));
		$this->assertEquals(1, $user->comments->count());
		$this->assertEquals(0, $comment->commentable->project_id);
		$this->assertEquals($project->id, $comment->commentable->id);
		$this->assertEquals(1, Feed::count());
		//~ $this->assertEquals(1, $user->relatedFeeds()->count());
	}
	
	/**
	 * COMMANDS TEST
	 */
	
	public function tearDown() {
		parent::tearDown();
		//~ Artisan::call('migrate:reset');
	}

}
