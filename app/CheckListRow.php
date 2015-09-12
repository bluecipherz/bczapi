<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckListRow extends Model {

	public function user() {
		return $this->belongsTo('App\User');
	}

	public function checklist() {
		return $this->belongsTo('App\CheckList');
	}

	public function checkmarks() {
		return $this->hasMany('App\CheckMark');
	}

}
