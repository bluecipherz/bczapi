<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Project;
use App\Task;
use App\Commands\CreateTask;
use App\Commands\CompleteTask;
use App\Commands\DeleteTask;
use JWTAuth;

class TaskController extends Controller {

	public function __construct() {
//		$this->middleware('jwt.auth');
		$this->middleware('project.access');
	}
	
	public function users(Task $task) {
		
	}
	
	public function updateUser(Task $task) {
		
	}
	
	public function addUser(Task $task) {
		
	}
	
	public function removeUser(Task $task) {
		
	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Project $project)
	{
		return $project->tasks;
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request, Project $project)
	{
		$user = JWTAuth::parseToken()->authenticate();
		$task = $this->dispatch(new CreateTask($user, $project, $request->all()));
		return response()->json(['success' => true, 'message' => 'Task Created.', 'task' => $task]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Project $project, Task $task, Request $request)
	{
		$user = JWTAuth::parseToken()->authenticate();
        $this->dispatch(new UpdateTask($user, $task, $request->all()));
        return response()->json(['success' => true, 'message' => 'Task Updated.']);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Project $project, Task $task)
	{
		$user = JWTAuth::parseToken()->authenticate();
		$this->dispatch(new DeleteTask($user, $project, $task));
        return response()->json(['success' => true, 'message' => 'Task Deleted.']);
	}

}
