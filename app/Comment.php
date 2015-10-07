<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model {

	use SoftDeletes;

	protected $fillable = ['comment'];

	// protected $with = ['owner'];

	public function commentable() {
        return $this->belongsTo('App\Feed', 'feed_id');
    }
    
    public function feed() {
        return $this->morphOne('App\Feed', 'subject');
    }
	
	public function images() {
		return $this->morphMany('App\Image', 'imageable');
	}
	
	public function owner() {
		return $this->belongsTo('App\User', 'user_id');
	}
    
    public function attachments() {
        return $this->morphMany('App\Attachment', 'attachable');
    }

}
