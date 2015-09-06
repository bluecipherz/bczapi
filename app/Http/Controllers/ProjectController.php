<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Project;
use App\User;
use App\Commands\AddUserToProject;
use App\Commands\RemoveUserFromProject;
use App\Commands\CreateProject;
use App\Commands\DeleteProject;
use JWTAuth;
use Input;
use Validator;

class ProjectController extends Controller {

	public function __construct() {
		// $this->middleware('jwt.auth', ['except' => ['index']]);
		$this->middleware('project.auth', ['only' => ['destroy']]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user = JWTAuth::parseToken()->authenticate();
		return $user->ownProjects;
		// return Project::all();
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$rules = [
			'name' => 'required',
			'description' => 'required'
		];
		$this->validate($request, $rules);
        $user = JWTAuth::parseToken()->authenticate();
        $project = $this->dispatch(
            new CreateProject($user, $request->except('token'))
        );
        return $project;
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Project $project)
	{
		$user = JWTAuth::parseToken()->authenticate();
		$this->dispatch(new DeleteProject($user, $project));
		return response()->json(['success' => true, 'message' => 'Project deleted.']);
	}
	
	public function join(Project $project, User $user, Request $request) {
		$rules = [
			'type' => 'required|in:owner,developer,client'
		];
		$validator = Validator::make($request->all(), $rules);
		if($validator->fails()) {
			return response()->json(['fail' => true, 'messages' => $validator->messages()], 400);
		}
		$admin = JWTAuth::parseToken()->authenticate();
		$type = $request->get('type');
		$this->dispatch(new AddUserToProject($admin, $project, $user, $type));
		return response()->json(['success' => true]);
	}
	
	public function leave(Project $project, User $user) {
		$admin = JWTAuth::parseToken()->authenticate();
		$this->dispatch(new RemoveUserFromProject($admin, $project, $user));
		return response()->json(['success' => true]);
	}
	
	public function users(Project $project) {
		return $project->users;
	}

}
