<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Backlog extends Model {

	protected $fillable = ['name'];
	
	public function sprints(){
		return $this->hasMany('App\Sprint');
	}

}
