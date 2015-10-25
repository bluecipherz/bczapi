<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Sprint extends Model {

	protected $fillable = ['name','release'];

	public function stories() {
		return $this->hasMany('App\Story');
	}

}
