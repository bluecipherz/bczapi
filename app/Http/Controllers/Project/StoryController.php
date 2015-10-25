<?php namespace App\Http\Controllers\Project;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Project;
use App\Story;
use JWTAuth;

class StoryController extends Controller {

	public function store(Project $project,Request $request)
	{
		$user = JWTAuth::parseToken()->authenticate();
		$story=Story::create($request->only('name'));
		$project->stories()->save($story);
		$user->stories()->save($story);
		return response()->json(['status'=>'success','story'=>$story,'message'=>'Story created.']);
	}

	public function update(Project $project,Story $story,Request $request)
	{
		$story->update($request->only('name'));
		return response()->json(['status'=>'success','story'=>$story,'message'=>'Story updated.']);
	}

	public function destroy(Project $project,Story $story,Request $request)
	{
		$story->delete();
		return response()->json(['status'=>'success','message'=>'Story deleted.']);
	}

}
