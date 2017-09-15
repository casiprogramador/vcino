<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    public function company()
    {
        return $this->belongsTo('App\Company');
    }
	
	public function maintenanceplans()
    {
        return $this->hasMany('App\MaintenancePlan','equipment_id');
    }
	
	public function maintenancerecords()
    {
        return $this->hasMany('App\MaintenanceRecord','equipment_id');
    }
}
