<?php namespace App\Events\Contracts;


interface FeedableEvent {
	
	public function getTitle();
	
	public function getFeedable();
	
	public function getProject();
	
}
