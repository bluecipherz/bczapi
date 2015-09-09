<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\JoinProjectRequest;
use App\Http\Requests\UpdateProjectUserRequest;
use App\Http\Requests\LeaveProjectRequest;
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
		$this->middleware('project.auth', ['only' => ['update', 'destroy', 'leave', 'join', 'updateUser']]);
		$this->middleware('project.access', ['only' => ['users']]);
        $this->middleware('privilege', ['only' => ['all', 'store']]);
	}

    public function all() {
        return Project::all();
    }
    
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user = JWTAuth::parseToken()->authenticate();
		return $user->projects;
		// return Project::all();
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(StoreProjectRequest $request)
	{
        $user = JWTAuth::parseToken()->authenticate();
        $project = $this->dispatch(new CreateProject($user, $request->all()));
        return response()->json(['success' => true, 'message' => 'Project Created.', 'project' => $project]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Project $project, Request $request)
	{
		$project->update($request->all());
        return response()->json(['success' => true, 'message' => 'Project Updated.']);
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
	
	public function join(Project $project, JoinProjectRequest $request) {
		$admin = JWTAuth::parseToken()->authenticate();
        $user = User::findOrFail($request->get('user_id'));
		$type = $request->get('type');
		$this->dispatch(new AddUserToProject($admin, $project, $user, $type));
		return response()->json(['success' => true, 'message' => 'User Joined Project.']);
	}
	
	public function leave(Project $project, User $user) {
		$admin = JWTAuth::parseToken()->authenticate();
		$this->dispatch(new RemoveUserFromProject($admin, $project, $user));
		return response()->json(['success' => true, 'message' => 'User Left Project.']);
	}
    
    public function updateUser(Project $project, User $user, UpdateProjectUserRequest $request) {
        $data = ['type' => $request->get('type')];
        $project->users()->updateExistingPivot($user->id, $data);
        return response()->json(['success' => true, 'message' => 'Project Member updated.']);
    }
	
	public function users(Project $project) {
		return $project->users;
	}

}
