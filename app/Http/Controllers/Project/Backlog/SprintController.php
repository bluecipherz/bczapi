<?php namespace App\Http\Controllers\Project\Backlog;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Project;
use App\Sprint;
use App\Backlog;
use App\Event\type;
use App\Event\subject;
use App\Event\project;
use App\Event\user;
use JWTAuth;
use App;


class SprintController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Project $project)
	{
		return $project->sprints;
	}

	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Project $project, Backlog $backlog , Request $request)
	{
		$user = JWTAuth::parseToken()->authenticate();
		// $sprint = App::make('App\Sprint')->create($request->only('name','release'));
		$sprint = Sprint::create($request->only('name'));
		$project->sprints()->save($sprint);
		$user->sprints()->save($sprint);
		event(new FeedableEvent('SprintCreated',$user,$sprint,$project));
		return response()->json(['status'=>'success','Sprint'=>$sprint,'Message'=>'Sprint created.']);
	}
	

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Project $project, Backlog $backlog , Sprint $sprint, Request $request)
	{
		$sprint->update($request->all());
		return response()->json(['status'=>'success','Message'=>'Sprint updated.']);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */	
	public function destroy(Project $project, Backlog $backlog ,Sprint $sprint)
	{
		$sprint->delete();
		event(new FeedableEvent('SprintDeleted',$user,$sprint,$project));
		return response()->json(['status'=>'success','Message'=>'Sprint deleted.']);
	}

}
