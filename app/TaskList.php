<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskList extends Model {

    protected $fillable = ['name'];

    // protected $with = ['tasks'];

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

    public function feed() {
        return $this->morphOne('App\Feed', 'subject');
    }
    
}
