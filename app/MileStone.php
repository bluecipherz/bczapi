<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class MileStone extends Model {

	public function tasklists() {
        return $this->hasMany('App\TaskList');
    }
    
    public function project() {
        return $this->belongsTo('App\Project');
    }
    
    public function user() {
        return $this->belongsTo('App\User');
    }
    
    public function feed() {
        return $this->morphOne('App\Feed', 'subject');
    }

}
