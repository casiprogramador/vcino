<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaintenancePlan extends Model
{
	public function company()
    {
        return $this->belongsTo('App\Company');
    }
	
	public function equipment()
    {
        return $this->belongsTo('App\Equipment','equipment_id');
    }
	
    public function maintenancerecords(){
		return $this->belongsToMany('App\MaintenanceRecord','maintenance_plans_records');
	}
}
