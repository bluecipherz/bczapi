<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model {

	use SoftDeletes;

	protected $fillable = ['comment'];

	public function commentable() {
        return $this->morphTo();
    }
    
    // no need. project in feed
    // just to restrict feed from showing outside of project
    //~ public function project() {
		//~ return $this->belongsTo('App\Project');
	//~ }
    
    public function feeds() {
        return $this->morphMany('App\Feed', 'subject');
    }
	
	public function images() {
		return $this->morphMany('App\Image', 'imageable');
	}
	
	public function owner() {
		return $this->belongsTo('App\User', 'user_id');
	}

}
