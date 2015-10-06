<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class MileStone extends Model {

    protected $fillable = ['name'];

    // protected $casts = [
    //     'completed' => 'boolean'
    // ];

    protected $with = ['tasklists'];

	public function tasklists() {
        return $this->hasMany('App\TaskList');
    }

    public function tasks() {
        return $this->hasMany('App\Task');
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
