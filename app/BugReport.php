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

    public function activities() {
        return $this->morphMany('App\Activity', 'subject');
    }

    public function comments() {
        return $this->morphMany('App\Comment', 'commentable');
    }
}
