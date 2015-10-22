<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Backlog extends Model {

	protected $fillable = ['name','release'];
	public function sprint(){
		return $this->hasMany('App/Sprint');
	}

}
