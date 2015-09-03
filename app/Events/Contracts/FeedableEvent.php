<?php namespace App\Events\Contracts;


interface FeedableEvent {
	
	public function getOrigin();
	
	public function getSubject();
	
	public function getTarget();
	
}
