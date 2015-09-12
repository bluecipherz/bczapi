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
		return $user->feeds()
			->with('subject.owner')
			->with('origin.userable')
			->with('context')
			->with('comments')
			->orderBy('updated_at')
			->get();
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
