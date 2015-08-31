<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model {
	
	protected $fillable = ['name'];

	public function messages() {
		return $this->hasMany('App\Message');
	}
	
	public function owner() {
		return $this->belongsTo('App\User', 'user_id');
	}
	
	public function users() {
		return $this->belongsToMany('App\User');
	}
	
	public function project() {
		return $this->belongsTo('App\Project');
	}
	
	public function feed() {
		return $this->morphOne('App\Feed', 'feedable');
	}
    

}
