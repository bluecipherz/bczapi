<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model {

	protected $hidden = [
		'origin_id',
		'subject_id',
		// 'subject_type',
		'context_id',
		'context_type',
		'pivot'
	];

	protected $with = ['subject.owner', 'origin.userable', 'comments.owner', 'context', 'project', 'additionalOrigin', 'additionalSubject'];

	protected $casts = [
		'context_id' => 'int'
	];

	public function origin() {
		return $this->belongsTo('App\User');
	}

	public function additionalOrigin() {
		return $this->belongsTo('App\User');
	}

	public function additionalSubject() {
		return $this->morphTo();
	}

	public function subject() {
        return $this->morphTo();
    }

    public function subjects() {
    	return $this->belongsToMany('App\User', 'feeds_subjects');
    }
    
    public function context() {
		return $this->morphTo();
	}
	
	public function project() {
		return $this->belongsTo('App\Project');
	}

	public function users() {
		return $this->belongsToMany('App\User', 'feeds_users')->withPivot('read');
	}
	
	public function feedable() {
		return $this->morphTo();
	}
	
	public function comments() {
		return $this->hasMany('App\Comment');
	}
	
    public function scopeCommon($query) {
        return $query->where('level', '=', 0);
    }
    
    public function scopeProject($query) {
		return $query->where('level', '>', 0);
	}

}
