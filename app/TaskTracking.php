<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskTracking extends Model
{
    public function company()
    {
        return $this->belongsTo('App\Company');
    }
	
	public function task()
    {
        return $this->belongsTo('App\Task');
    }
}
