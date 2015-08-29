<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model {

	protected $fillable = ['user_id', 'type', 'subject', 'body', 'notifiable_type', 'notifiable_id'];
	
	public function user() {
		return $this->belongsTo('App\User');
	}

}
