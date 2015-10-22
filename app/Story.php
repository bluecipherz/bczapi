<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Story extends Model {

	protected $fillable = ['name', 'description', 'priority', 'work_hours'];

	public function project() {
		return $this->belongsTo('App\Project');
	}

	public function createdBy() {
		return $this->belongsTo('App\User', 'user_id');
	}

	public function users() {
		return $this->belongsToMany('App\User', 'stories_users');
	}

	public function backlog() {
		return $this->belongsTo('App\Backlog');
	}

	public function sprint() {
		return $this->belongsTo('App\Sprint');
	}

}
