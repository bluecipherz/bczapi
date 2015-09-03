<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Project;
use App\Commands\CreateProject;
use JWTAuth;
use Input;

class ProjectController extends Controller {

	public function __construct() {
		// $this->middleware('jwt.auth', ['except' => ['index']]);
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
	public function destroy($id)
	{
		//
	}

}
