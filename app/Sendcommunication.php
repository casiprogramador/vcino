<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sendcommunication extends Model
{
	
	public function communication()
    {
        return $this->belongsTo('App\Communication');
    }
}
