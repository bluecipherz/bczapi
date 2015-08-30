<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model {

	public function feedable() {
        return $this->morphTo();
    }
    
    public function scopeCommon($query) {
        return $query->where('project_id', '=', '');
    }

}
