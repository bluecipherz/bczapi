<?php namespace App\Http\Controllers\Project;

use App\Http\Requests;
use App\Project;
use App\Backlog;
use App\Http\Controllers\Controller;
use JWTAuth;
use Illuminate\Http\Request;

class BacklogController extends Controller {


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Project $project,Request $request)
	{
		$user = JWTAuth::parseToken()->authenticate();
		$backlog=Backlog::create($request->only('name'));
		$project->backlogs()->save($backlog);
		$user->backlogs()->save($backlog);
		return response()->json(['status'=>'success', 'backlog' => $backlog]);
	}

		public function update(Project $project, Backlog $backlog, Request $request)
	{
		$backlog->update($request->all());
		return response()->json(['status'=>'success', 'backlog' => $backlog ,'message'=>'Backlog deleted.']);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Project $project, Backlog $backlog)
	{
		$backlog->delete();
		return response()->json(['status'=>'success','message'=>'Backlog deleted.']);
	}
}
