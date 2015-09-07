<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Project;
use App\Status;
use App\Commands\PostStatus;
use App\Commands\DeleteStatus;
use JWTAuth;

class StatusController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $user = JWTAuth::parseToken()->authenticate();
		return $user->statuses;
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$user = JWTAuth::parseToken()->authenticate();
        $project = Project::find($request->get('project'));
		$status = $this->dispatch(new PostStatus($user, $project, $request->all()));
		return response()->json(['success' => true, 'message' => 'Status Posted.', 'status' => $status]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
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
	public function destroy(Status $status)
	{
		$user = JWTAuth::parseToken()->authenticate();
        $this->dispatch(new DeleteStatus($user, $status));
        return response()->json(['success' => true, 'message' => 'Status Deleted.']);
	}

}
