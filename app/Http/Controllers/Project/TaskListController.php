<?php namespace App\Http\Controllers\Project;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Project;

class TaskListController extends Controller {

    // public function __construct()
    // {
    //     $this->middleware('project.access');
    // }
    
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Project $project)
	{
		return $project->tasklists;
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Project $project, Request $request)
	{
		$audience = User::whereIn('id', explode(',', $request->get('audience')))->get();
		$tasklist = $this->dispatch(new CreateTaskList($this->user, $project, $request->all(), $audience));
		return response()->json(['success' => true, 'message' => 'TaskList created.', 'tasklist' => $tasklist]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Project $project, TaskList $tasklist, Request $request)
	{
		$tasklist->update($request->all());
		return response()->json(['success' => true, 'message' => 'TaskList updated.']);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Project $project, TaskList $tasklist, Request $request)
	{
		$audience = User::whereIn('id', explode(',', $request->get('audience')))->get();
		$this->dispatch(new DeleteTaskList($this->user, $tasklist, $audience));
		return response()->json(['success' => true, 'message' => 'TaskList deleted.']);
	}

}
