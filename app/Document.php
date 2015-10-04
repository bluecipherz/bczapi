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

    public function feed() {
        return $this->morphOne('App\Feed', 'subject');
    }

    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function project() {
    	return $this->belongsTo('App\Project');
    }

}
