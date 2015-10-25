<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Sprint extends Model {

	protected $fillable = ['name','release'];

	public function stories() {
		return $this->hasMany('App\Story');
	}

    public function activities() {
        return $this->morphMany('App\Activity', 'subject');
    }

    public function comments() {
        return $this->morphMany('App\Comment', 'commentable');
    }
}
