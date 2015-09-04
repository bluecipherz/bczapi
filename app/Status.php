<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model {

	use SoftDeletes;
	
	protected $fillable = ['message'];
	
	public function images() {
		return $this->morphMany('App\Image', 'imageable');
	}
	
	public function owner() {
		return $this->belongsTo('App\User', 'user_id');
	}
	
	public function feeds() {
		return $this->morphMany('App\Feed', 'subject');
	}
	
	public function project() {
		return $this->belongsTo('App\Project');
	}
	
	public function scopeCommon($query) {
		return $query->where('project_id', '=', 0);
	}
	
	public function scopeCommon($query) {
		return $query->where('project_id', '>', 0);
	}

}
