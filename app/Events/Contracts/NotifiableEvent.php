<?php namespace App\Events\Contracts;


interface NotifiableEvent {
	
	public function getSubject();
	
	public function getBody();
	
	public function getType();
	
}