<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

	protected $fillable = ['comment'];

	public function commentable() {
        return $this->morphTo();
    }
    
    public function feed() {
        return $this->morphOne('App\Feed', 'feedable');
    }
	
	public function images() {
		return $this->morphMany('App\Image', 'imageable');
	}
	
	public function owner() {
		return $this->belongsTo('App\User', 'user_id');
	}

}
