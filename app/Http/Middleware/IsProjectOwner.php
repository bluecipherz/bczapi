<?php namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use App\Project;

class IsProjectOwner {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$user = JWTAuth::parseToken()->authenticate();
		$projectId = $request->input('project');
		if(Project::find($projectId)->users->contains($user))
			return $next($request);
		return response()->json(['fail' => true, 'message' => 'Not project owner']);
	}

}
