<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskList extends Model {

	public function tasks() {
        return $this->hasMany('App\Task');
    }
    
    public function milestone() {
        return $this->belongsTo('App\MileStone');
    }

    public function project() {
        return $this->belongsTo('App\Project');
    }
    
    public function user() {
        return $this->belongsTo('App\User');
    }
    
}
