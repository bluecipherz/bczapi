<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model {

	protected $hidden = ['origin_id', 'subject_id', 'subject_type', 'target_id', 'target_type'];

	public function origin() {
		return $this->belongsTo('App\User');
	}

	public function subject() {
        return $this->morphTo();
    }
    
    public function target() {
		return $this->morphTo();
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
