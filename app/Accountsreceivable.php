<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accountsreceivable extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
	
	public function company()
    {
        return $this->belongsTo('App\Company');
    }
	
	public function property()
    {
        return $this->belongsTo('App\Property','property_id');
    }
	
	public function quota()
    {
        return $this->belongsTo('App\Quota');
    }
	
	public function tasks(){
		return $this->belongsToMany('App\Task','tasks_accountsreceivables')->withTimestamps();
	}
}
