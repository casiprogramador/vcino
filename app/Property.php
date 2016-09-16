<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function situacionhabitacional()
    {
        return $this->belongsTo('App\ModelsSupport\SituacionHabitacional');
    }
	
	public function internetservice()
    {
        return $this->belongsTo('App\ModelsSupport\Internetservice');
    }
	
	public function waterservice()
    {
        return $this->belongsTo('App\ModelsSupport\Waterservice');
    }
	
	public function tvservice()
    {
        return $this->belongsTo('App\ModelsSupport\Tvservice');
    }
	
	public function phoneservice()
    {
        return $this->belongsTo('App\ModelsSupport\PhoneService');
    }
	
	public function electricservice()
    {
        return $this->belongsTo('App\ModelsSupport\Electricservice');
	}
    
}
