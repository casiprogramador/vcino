<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Communication extends Model
{
    public function company()
    {
        return $this->belongsTo('App\Company');
    }
	
	public function sendcommunication()
    {
        return $this->hasMany('App\Sendcommunication');
    }
	
	public function getFechaAsuntoAttribute(){
		return $this->attributes['fecha'] . " - " . $this->attributes['asunto'];
	}
}
