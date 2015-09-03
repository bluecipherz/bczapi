<?php

class ControllersTest extends TestCase {

    public function testHomeroute() {
        $response = $this->call('GET', '/api/home'); // home
        $this->assertResponseStatus(400);
        $response = $this->call('POST', '/api/projects'); // create project
        $this->assertResponseStatus(400);
        $project = \App\Project::firstOrFail();
        $response = $this->call('POST', "/api/projects/{$project}/tasks"); // create task
        $this->assertResponseStatus(400);
    }
    
    public function testAuthTest() {
        $credentials = [
            'email' => 'asd@g.com',
            'password' => 'asdasd'
        ];
        $response = $this->call('POST', '/api/authenticate', $credentials);
        $content = json_decode($response->getContent(), true);
        $token = $content['token'];
        //$response = $this->call('GET', '/api/authenticate/user', ['token' => $token]);
        //$this->assertResponseStatus(200);
        //$response = $this->call('GET', "/api/home?token={$token}"); // home
        // echo $response->getContent();
        $data = array_merge(['token' => $token], $this->projectdata);
        $response = $this->call('POST', "/projects/", ['token' => $token]); // create projects
        echo $response->getContent();
        $this->assertResponseStatus(200);
    }
    

}
