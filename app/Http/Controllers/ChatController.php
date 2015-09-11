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
        return Chat::all();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateChatRequest $request)
	{
		$user = JWTAuth::parseToken()->authenticate();
       	$audience = User::whereIn('id', explode(',', $request->get('audience')))->get();
        $chat = $this->dispatch(new CreateChatRoom($user, null, $request->all(), $audience));
        return response()->json(['success' => true, 'message' => 'Chat Created.', 'chat' => $chat]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Chat $chat, Request $request)
	{
		$chat->update($request->all());
		return response()->json(['success' => true, 'message' => 'Chat Updated.']);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Chat $chat, DeleteChatRequest $request)
	{
        $user = JWTAuth::parseToken()->authenticate();
       	$audience = User::whereIn('id', explode(',', $request->get('audience')))->get();
        $this->dispatch(new DeleteChatRoom($user, $chat, $audience));
        return response()->json(['success' => true, 'message' => 'Chat Deleted.']);
	}

}
