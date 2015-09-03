<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model {

	public function origin() {
		return $this->belongsTo('App\User');
	}

	public function subject() {
        return $this->morphTo();
    }
    
    public function target() {
		return $this->morphTo();
	}
    
    public function scopeCommon($query) {
        return $query->where('level', '=', 0);
    }
    
    public function scopeProject($query) {
		return $query->where('level', '>', 0);
	}

}
