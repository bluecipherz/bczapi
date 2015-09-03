<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Project;
use App\Commands\CreateProject;
use JWTAuth;

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
		if(Input::get('token')) {
			$user = JWTAuth::parseToken()->authenticate();
			return $user->projects;
		}
		return response(['error' => 'wheres_the_f***ing_token'], 400);
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
