<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaintenanceRecord extends Model
{
    public function company()
    {
        return $this->belongsTo('App\Company');
    }
	
    public function maintenanceplans(){
		return $this->belongsToMany('App\MaintenancePlan','maintenance_plans_records')->withTimestamps();
	}
	
	public function equipment()
    {
        return $this->belongsTo('App\Equipment','equipment_id');
    }
	
	public function supplier()
    {
        return $this->belongsTo('App\Supplier');
    }
}
