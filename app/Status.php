<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model {

	use SoftDeletes;
	
	protected $fillable = ['message'];
	
	public function images() {
		return $this->morphMany('App\Image', 'imageable');
	}
	
	public function owner() {
		return $this->belongsTo('App\User', 'user_id');
	}
	
	public function feed() {
		return $this->morphOne('App\Feed', 'subject');
	}
	
	public function project() {
		return $this->belongsTo('App\Project');
	}
	
	public function scopeCommon($query) {
		return $query->where('project_id', '=', 0);
	}
	
	public function scopeProject($query) {
		return $query->where('project_id', '>', 0);
	}
    
    public function attachments() {
        return $this->morphMany('App\Attachment', 'attachable');
    }

}
