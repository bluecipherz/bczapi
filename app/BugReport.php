<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class BugReport extends Model {

	public function project() {
        return $this->belongsTo('App\Project');
    }
    
    public function attachments() {
        return $this->morphMany('App\Attachment');
    }
    
    public function user() {
        return $this->belongsTo('App\User', 'assigned_to');
    }
    
    public function owner() {
        return $this->belongsTo('App\User', 'user_id');
    }
    
    public function feed() {
        return $this->morphOne('App\Feed', 'subject');
    }

}
