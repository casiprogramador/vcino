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
	
	public function tasktrackings()
    {
        return $this->hasMany('App\TaskTracking');
    }
	
	public function accountreceivables(){
		return $this->belongsToMany('App\Accountsreceivable','tasks_accountsreceivables','task_id','accountreceivable_id')->withTimestamps();
	}
}
