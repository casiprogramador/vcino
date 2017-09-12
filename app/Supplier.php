<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    public function company()
    {
        return $this->belongsTo('App\Company');
    }
	
	public function expenses()
    {
        return $this->hasMany('App\Expenses');
    }
	
	public function maintenancerecords()
    {
        return $this->hasMany('App\MaintenanceRecord','equipment_id');
    }
}
