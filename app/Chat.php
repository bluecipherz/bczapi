<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chat extends Model {
	
	use SoftDeletes;
	
	protected $fillable = ['name'];

	public function messages() {
		return $this->hasMany('App\Message');
	}
	
	public function owner() {
		return $this->belongsTo('App\User', 'user_id');
	}
	
	public function users() {
		return $this->belongsToMany('App\User', 'users_chats')->withTimestamps()->withPivot('type');
	}
	
	public function project() {
		return $this->belongsTo('App\Project');
	}
	
	public function feeds() {
		return $this->morphMany('App\Feed', 'subject');
	}
	
    public function memberActions() {
		return $this->morphMany('App\MemberAction', 'memberable');
	}
    
    public function scopeCommon($query) {
		return $query->where('project_id', '=', 0);
	}
	
	public function scopeProject($query) {
		return $query->where('project_id', '>', 0);
	}

}
