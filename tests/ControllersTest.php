<?php

use App\Commands\PostComment;
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
    
    public function testComment() {
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
	
	public function testMakeModel() {
		$feed = $this->app->make('App\Feed')->firstOrFail();
		$this->assertNotNull($feed);
		echo "\n{$feed}";
	}
    

}
