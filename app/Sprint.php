<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Sprint extends Model {

	protected $fillable = ['name','release'];

	public function story(){
		return $this->hasMany('App\Story');
	}

}
