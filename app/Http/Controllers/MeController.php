<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use JWTAuth;

class MeController extends Controller {

	/**
	 * 
	 */
	public function projects() {
		$user = JWTAuth::parseToken()->authenticate();
		return $user;
	}

	/**
	 * 
	 */
	public function feeds() {
		$user = JWTAuth::parseToken()->authenticate();
		$feeds = $user->feeds()
			->with('subject.owner')
			->with('origin.userable')
			->with('context')
			->with('comments')
			->orderBy('updated_at')
			->map(function($feed) {
				if($feed->context_type == 'App\Feed') {
					$feed->context = App\Feed::whereId($feed->context_id)
					->with('subject.owner')
					->with('origin.userable')
					->with('context')
					->with('comments')->get();
				}
				return $feed;
			})->filter(function($feed) {
				return !App\Feed::whereContextId($feed->id)->whereContextType("App\Feed")->exists();
			});
		return $feeds;
	}

	public function notifications() {
		$user = JWTAuth::parseToken()->authenticate();
		return $user->notifications;
	}

	public function tasks() {
		$user = JWTAuth::parseToken()->authenticate();
		return $user->tasks;
	}

	public function tasklists() {
		$user = JWTAuth::parseToken()->authenticate();
		return $user->tasklists;
	}

	public function milestones() {
		$user = JWTAuth::parseToken()->authenticate();
		return $user->milestones;
	}

	public function checklists() {
		$user = JWTAuth::parseToken()->authenticate();
		return $user->checklists;
	}

}
