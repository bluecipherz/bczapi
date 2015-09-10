<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model {

	protected $hidden = ['origin_id', 'subject_id', 'subject_type', 'context_id', 'context_type', 'pivot'];

	public function origin() {
		return $this->belongsTo('App\User');
	}

	public function subject() {
        return $this->morphTo();
    }
    
    public function context() {
		return $this->morphTo();
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
	
	public function getTypeAttribute($value) {
		$tokens =  explode('\\', $value);
		return $tokens[sizeof($tokens)-1];
	}
    
    public function scopeCommon($query) {
        return $query->where('level', '=', 0);
    }
    
    public function scopeProject($query) {
		return $query->where('level', '>', 0);
	}

}
