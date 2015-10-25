<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Backlog extends Model {

	protected $fillable = ['name'];
	
	public function sprints(){
		return $this->hasMany('App\Sprint');
	}

    public function activities() {
        return $this->morphMany('App\Activity', 'subject');
    }

    public function comments() {
        return $this->morphMany('App\Comment', 'commentable');
    }
}
