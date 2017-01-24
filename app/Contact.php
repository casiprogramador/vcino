<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public function property()
    {
        return $this->belongsTo('App\Property','property_id');
    }
	
    public function typecontact()
    {
        return $this->belongsTo('App\ModelsSupport\Typecontact','typecontact_id');
    }
	
    public function relationcontact()
    {
        return $this->belongsTo('App\ModelsSupport\Relationcontact','relationcontact_id');
    }
	
    public function media()
    {
        return $this->belongsTo('App\ModelsSupport\Media','media_id');
    }
	
	public function collections()
    {
        return $this->hasMany('App\Collection');
    }
	
	//Mutator
	
	public function getFullNameAttribute(){
		return $this->attributes['nombre'] . " " . $this->attributes['apellido'];
	}
	
}
