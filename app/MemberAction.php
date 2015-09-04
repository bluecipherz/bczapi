<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberAction extends Model {

	protected $fillable = ['type'];

	public function memberable() {
		return $this->morphTo();
	}
	
	public function admin() {
		return $this->belongsTo('App\User', 'admin_id');
	}
	
	public function user() {
		return $this->belongsTo('App\User', 'user_id');
	}

}
