<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model {

	protected $fillable = ['type'];

	public function user() {
		return $this->belongsTo('App\User');
	}

	public function subject() {
		return $this->morphTo();
	}

	public function participants() {
		return $this->belongsToMany('App\User');
	}

	public function project() {
		return $this->belongsTo('App\Project');
	}

}
