<?php namespace App\Http\Controllers\Project;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use JWTAuth;
use App\Project;
use App\Chat;
use App\Commands\CreateChatRoom;

class ChatController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Project $project)
	{
		return $project->chats;
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
		$chat = $this->dispatch(new CreateChatRoom($user, $project, $request->all(), $audience));
		return response()->json(['success' => true, 'message' => 'Project Chat Created.', 'chat' => $chat]);
	}

}
