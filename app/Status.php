<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model {

	public function images() {
		return $this->morphMany('App\Image', 'imageable');
	}
	
	public function scopeProject($query) {
		return $query->where('project_id', '!=', '0');
	}
	
	public function scopeGeneral($query) {
		return $query->where('project_id', '=', '0');
	}

}
