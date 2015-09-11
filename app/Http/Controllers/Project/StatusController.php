<?php namespace App\Http\Controllers\Project;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Project;
use App\Status;
use JWTAuth;

class StatusController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Project $project)
	{
    	return $project->statuses;
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Project $project, Request $request)
	{
		$user = JWTAuth::parseToken()->authenticate();
		$audience = User::whereIn('id', explode(',', $request->get('audience')))->get();
		$status = $this->dispatch(new PostStatus($user, $project, $request->all(), $audience));
		return response()->json(['success' => true, 'message' => 'Status Posted.', 'status' => $status]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Project $project, Status $status, Request $request)
	{
		$status->update($request->all());
		return response()->json(['success' => true, 'message' => 'Status Updated.']);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Project $project, Status $status)
	{
		$user = JWTAuth::parseToken()->authenticate();
		$audience = User::whereIn('id', explode(',', $request->get('audience')))->get();
        $this->dispatch(new DeleteStatus($user, $status, $audience));
        return response()->json(['success' => true, 'message' => 'Status Deleted.']);
	}


}
