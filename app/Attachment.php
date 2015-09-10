<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model {

	public function attachable() {
        return $this->morphTo();
    }
    
    public function feed() {
        return $this->morphOne('App\Feed', 'subject');
    }

}
