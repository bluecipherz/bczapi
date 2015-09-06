<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Validator;
use App\Commands\PostComment;
use JWTAuth;
use App;
use App\Comment;
use App\Commands\DeleteComment;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\DeleteCommentRequest;

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
	public function store(StoreCommentRequest $request)
	{
		$user = JWTAuth::parseToken()->authenticate();
		$input = $request->all();
		$commentable = App::make('App\\' . ucfirst($input['commentable_type']))->findOrFail($input['commentable_id']);
		$comment = $this->dispatch(new PostComment($user, $input, $commentable));
		return response()->json(['success' => true, 'message' => 'Comment Posted.', 'comment' => $comment], 200);
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
	public function destroy(DeleteCommentRequest $request, Comment $comment)
	{
		$user = JWTAuth::parseToken()->authenticate();
		$this->dispatch(new DeleteComment($user, $comment));
		return response()->json(['success' => true, 'message' => 'Comment Deleted.']);
	}

}
