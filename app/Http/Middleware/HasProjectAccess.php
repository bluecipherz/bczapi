<?php namespace App\Http\Middleware;

use Closure;

class HasProjectAccess {

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
        $project = Project::find($request->get('project'));
        if($project->users->contains($user->id)) {
            return $next($request);   
        }
        return response(['project access denied'], 401);
	}

}
