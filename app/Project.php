<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model {
	
	use SoftDeletes;

	protected $fillable = ['name', 'description'];

	// protected $appends = ['task_completion', 'milestone_completion', 'project_completion'];

	protected $with = ['users', 'stories', 'sprints', 'backlogs'];

	protected $casts = [
		'private' => 'boolean',
		'show_overview' => 'boolean'
	];

	public function sprints() {
		return $this->hasMany('App\Sprint');
	}

	public function backlogs() {
		return $this->hasMany('App\Backlog');
	}

	public function stories() {
		return $this->hasMany('App\Story');
	}

	public function getTaskCompletionAttribute() {
		return array(
			'tasks' => $this->tasks->count(),
			'completed' => $this->tasks()->wherePercentageCompleted(100)->count()
		);
	}

	public function getMilestoneCompletionAttribute() {
		return array(
			'milestones' => $this->milestones->count(),
			'completed' => $this->milestones()->whereCompleted(true)->count()
		);
	}

	public function getProjectCompletionAttribute() {
		return 100;
	}

	public function milestones() {
		return $this->hasMany('App\MileStone');
	}

	public function tasklists() {
		return $this->hasMany('App\TaskList');
	}

	public function tasks() {
		return $this->hasMany('App\Task');
	}
	
	public function invoice() {
		return $this->hasOne('App\Invoice');
	}
	
	public function images() {
		return $this->morphMany('App\Image', 'imageable');
	}
	
	public function forums() {
		return $this->hasMany('App\Forum');
	}
	
	public function chats() {
		return $this->hasMany('App\Chat');
	}
	
	public function statuses() {
		return $this->hasMany('App\Status');
	}
	
	/**
	 * Members involved in this project. Stored in pivot.
	 */
	public function users() {
		return $this->belongsToMany('App\User', 'users_projects')->withTimestamps()->withPivot('type');
	}

	public function activities(){

		return $this->morphMany('App\Project', 'subject');

	}
    
    public function feed() {
        return $this->morphOne('App\Feed', 'subject');
    }
    
    public function feeds() {
        return $this->hasMany('App\Feed');
    }
    
    public function memberActions() {
		return $this->morphMany('App\MemberAction', 'memberable');
	}
    
    public function clients($query) {
		return $this->users()->whereType('client')->get();
	}
	
	public function developers($query) {
		return $this->users()->whereType('developer')->get();
	}
	
	/**
	 * Creator of the project. Stored in same table.
	 */
	public function owner() {
		return $this->users()->whereType('owner')->get();
	}

	public function createdBy() {
		return $this->belongsTo('App\User');
	}
    
    public function attachments() {
        return $this->morphMany('App\Attachment', 'attachable');
    }

}
