<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckList extends Model {

	public function task() {
        return $this->belongsTo('App\Task');
    }
    
    public function owner() {
        return $this->belongsTo('App\User');
    }
    
    public function feed() {
        return $this->morphOne('App\Feed', 'subject');
    }

    public function checkmarks() {
    	return $this->hasMany('App\CheckMark');
    }

    public function checklistrows() {
    	return $this->hasMany('App\CheckListRow');
    }

    public function checklistcolumns() {
    	return $this->hasMany('App\CheckListColumn');
    }

}
