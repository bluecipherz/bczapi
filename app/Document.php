<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model {

	protected $fillable = [
		'url',
		// 'description'
	];

	public function attachments() {
		return $this->morphMany('App\Attachment', 'attachable');
	}

    public function activities() {
        return $this->morphMany('App\Activity', 'subject');
    }

    public function comments() {
        return $this->morphMany('App\Comment', 'commentable');
    }

    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function project() {
    	return $this->belongsTo('App\Project');
    }

}
