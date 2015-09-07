<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use JWTAuth;
use App\Commands\CreateChatRoom;
use App\Chat;
use App\Project;
use App\Commands\DeleteChatRoom;
use App\Http\Requests\CreateChatRequest;
use App\Http\Requests\DeleteChatRequest;

class ChatController extends Controller {

	public function __construct() {
//		$this->middleware('jwt.auth');
//        $this->middleware('chat.admin');
	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user = JWTAuth::parseToken()->authenticate();
        return $user->chats;
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
	public function store(CreateChatRequest $request)
	{
		$user = JWTAuth::parseToken()->authenticate();
        $project = Project::find($request->get('project'));
        $chat = $this->dispatch(new CreateChatRoom($user, $project, $request->all()));
        return response()->json(['success' => true, 'message' => 'Chat Created.', 'chat' => $chat]);
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
	public function destroy(Chat $chat)
	{
        $user = JWTAuth::parseToken()->authenticate();
        $this->dispatch(new DeleteChatRoom($user, $chat));
        return response()->json(['success' => true, 'message' => 'Chat Deleted.']);
	}

}
