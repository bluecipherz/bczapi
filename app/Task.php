<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model {

	use SoftDeletes;
	
	protected $fillable = ['name', 'description'];

    protected $casts = [
        'percentage_completed' => 'int',
        'task_list_id' => 'int'
    ];

    protected $with = ['users'];

	public function project() {
		return $this->belongsTo('App\Project');
	}

    public function users() {
        return $this->belongsToMany('App\User', 'users_tasks')->withTimestamps();
    }
    
	public function owner() {
		return $this->users()->whereType('owner');
	}
	
	public function images() {
		return $this->morphMany('App\Image', 'imageable');
	}
    
    public function feed() {
        return $this->morphOne('App\Feed', 'subject');
    }
    
    public function attachments() {
        return $this->morphMany('App\Attachment', 'attachable');
    }
    
    public function tasklist() {
        return $this->belongsTo('App\TaskList');
    }
    
    public function checklists() {
        return $this->hasMany('App\CheckList');
    }

    public function milestone() {
        return $this->belongsTo('App\MileStone');
    }
    
    public function createdBy() {
        return $this->belongsTo('App\User');
    }
    
}
