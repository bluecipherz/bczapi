<?php namespace App\Http\Controllers\Project;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class DocumentController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Project $project)
	{
		return $project->documents;
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Project $project, Request $request)
	{
		$document = $project->documents()->create($request->all());
		return response()->json(['success' => true, 'message' => 'Document uploaded.', 'document' => $document]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Project $project, Document $document, Request $request)
	{
		$document->update($request->all());
		return response()->json(['success' => true, 'message' => 'Document updated.']);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Project $project, Document $document)
	{
		$document->delete();
		return response()->json(['success' => true, 'message' => 'Document deleted.']);
	}

}
