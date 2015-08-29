<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model {

	public function project() {
		return $this->belongsTo('App\Project');
	}

	public function user() {
		return $this->belongsTo('App\User');
	}
	
	public function completedBy() {
		return $this->belongsTo('App\User', 'completed_by');
	}
	
	public function images() {
		return $this->morphMany('App\Image', 'imageable');
	}
	
}
