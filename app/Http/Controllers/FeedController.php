<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Feed;
use JWTAuth;
use App\Commands\PostComment;
use App\Commands\DeleteComment;

class FeedController extends Controller {

	public function getComments(Feed $feed) {
		return $feed->comments;
	}

	public function postComment(Feed $feed, Request $request) {
		$user = JWTAuth::parseToken()->authenticate();
		$comment = $this->dispatch(new PostComment($user, $request->all(), $feed));
		return $comment;
	}
	
	public function deleteComment(Feed $feed, Comment $comment) {
		$user = JWTAuth::parseToken()->authenticate();
		$this->dispatch(new DeleteComment($user, $comment, $feed));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user = JWTAuth::parseToken()->authenticate();
		return $user->feeds()
			->with('subject.owner')
			->with('origin.userable')
			->with('context')
			->with('comments')
			->orderBy('updated_at')
			->get();
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
	public function store()
	{
		//
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