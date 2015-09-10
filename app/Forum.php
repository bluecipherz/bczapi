<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Forum extends Model {
	
	use SoftDeletes;
	
	protected $fillable = ['name', 'description'];
	
	public function owner() {
		return $this->belongsTo('App\User', 'user_id');
	}
    
    public function feed() {
        return $this->morphOne('App\Feed', 'subject');
    }
    
	public function project() {
		return $this->belongsTo('App\Project');
	}
    
    public function attachments() {
        return $this->morphMany('App\Attachment', 'attachable');
    }

}
