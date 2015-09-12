<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckMark extends Model {

	public function user() {
		return $this->belongsTo('App\User');
	}

	public function checklist() {
		return $this->belongsTo('App\CheckList');
	}

	public function checklistrow() {
		return $this->belongsTo('App\CheckListRow');
	}

	public function checklistcolumn() {
		return $this->belongsTo('App\CheckListColumn');
	}

}
