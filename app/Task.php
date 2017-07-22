<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function company()
    {
        return $this->belongsTo('App\Company');
    }
	
	public function taskrequest()
    {
        return $this->hasOne('App\TaskRequest');
    }
	
	public function taskreservation()
    {
        return $this->hasOne('App\TaskReservation');
    }
}
