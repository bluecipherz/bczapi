<?php

use App\Commands\PostComment;
use App\Commands\DeleteComment;
use App\Feed;
use App\User;

class ControllersTest extends TestCase {

    public function stestHomeroute() {
        $response = $this->call('GET', '/api/home'); // home
        $this->assertResponseStatus(400);
        $response = $this->call('POST', '/api/projects'); // create project
        $this->assertResponseStatus(400);
        // $project = \App\Project::firstOrFail();
        // $response = $this->call('POST', "/api/projects/{$project}/tasks"); // create task
        // $this->assertResponseStatus(400);
    }
    
    public function stestAuthTest() {
        $credentials = [
            'email' => 'asd@g.com',
            'password' => 'asdasd'
        ];
        $response = $this->call('POST', '/api/authenticate', $credentials);
		$this->assertResponseStatus(200);
        $content = json_decode($response->getContent(), true);
        $token = $content['token'];
        //$response = $this->call('GET', '/api/authenticate/user', ['token' => $token]);
        //$this->assertResponseStatus(200);
        //$response = $this->call('GET', "/api/home?token={$token}"); // home
        // echo $response->getContent();
        $data = array_merge(['token' => $token], $this->projectdata);
        $response = $this->call('POST', "/api/projects", ['token' => $token]); // create projects
        echo $response->getContent();
        $this->assertResponseStatus(200);
    }
    
    public function stestComment() {
		$cd = [
			'comment' => 'lets bring the pain'
		];
		$count = Feed::count();
		$feed = Feed::firstOrFail();
		$user = User::firstOrFail();
		$comment = Bus::dispatch(new PostComment($user, $cd, $feed));
		$ncount = Feed::count();
		$this->assertEquals($count, $ncount);
		$this->assertEquals($user->id, Feed::all()->last()->origin->id);
		//~ echo "old count : {$count}, new count : {$ncount}";
	}

	public function stestMakeModel() {
		$feed = $this->app->make('App\Feed')->firstOrFail();
		$this->assertNotNull($feed);
		echo "\n{$feed}";
	}
	
	public function testDeleteFeed() {
		DB::table('comments')->delete();
		$cd = [
			'comment' => 'lets bring the pain'
		];
		$feed = Feed::firstOrFail();
		$user1 = User::firstOrFail();
		$user2 = User::all()->last();
		$comment1 = Bus::dispatch(new PostComment($user1, $cd, $feed));
		$comment2 = Bus::dispatch(new PostComment($user2, $cd, $feed));
		$commentFeed = Feed::whereType('App\Events\CommentPosted')->whereContextId($feed->id)->firstOrFail();
		$this->assertEquals($user2->id, $commentFeed->origin->id);
		$this->assertEquals($comment2->id, $commentFeed->subject->id);
		Bus::dispatch(new DeleteComment($user2, $comment2));
		$this->assertEquals($user1->id, $commentFeed->origin->id);
		$this->assertEquals($comment1->id, $commentFeed->subject->id);
	}
	public function testSample() {
		$this->assertTrue(true);
	}

}
