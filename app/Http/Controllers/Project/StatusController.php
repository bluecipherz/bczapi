<?php namespace App\Http\Controllers\Project;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User;
use App\Project;
use App\Status;
use App\Feed;
use JWTAuth;
use App\Commands\PostStatus;

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
		$this->validate($request, ['message' => 'required']);
		$user = JWTAuth::parseToken()->authenticate();
		// $audience = User::whereIn('id', explode(',', $request->get('audience')))->get();
		$status = $this->dispatch(new PostStatus($user, $project, $request->all()));
		$feed = Feed::whereType('StatusPosted')->whereSubjectId($status->id)->first();
		return response()->json(['success' => true, 'message' => 'Status Posted.', 'status' => $status, 'feed' => $feed]);
	}

}
