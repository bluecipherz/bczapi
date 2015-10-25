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
	
	public function owner() {
		return $this->belongsTo('App\User', 'user_id');
	}
    
	public function attachment() {
		return $this->hasOne('App\Attachment', 'attachable');
	}

}
