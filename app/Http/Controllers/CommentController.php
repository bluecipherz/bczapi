<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Validator;
use App\Commands\PostComment;
use JWTAuth;
use App;

class CommentController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
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
		$rules = [
			'commentable_id' => 'required',
			'commentable_type' => 'required|in:feed',
			'comment' => 'required'
		];
		$input = $request->all();
		$validator = Validator::make($input, $rules);
		if($validator->fails()) return response()->json(['fail' => true, 'messages' => $validator->messages()], 400);
		$commentable = App::make('App\\' . ucfirst($input['commentable_type']))->findOrFail($input['commentable_id']);
		$this->dispatch(new PostComment($user, $input, $commentable));
		return response()->json(['success' => true], 200);
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
	public function destroy($id)
	{
		//
	}

}
