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
	
	public function taskrequest()
    {
        return $this->hasMany('App\TaskRequest');
    }
	
	public function taskreservation()
    {
        return $this->hasMany('App\TaskReservation');
    }
	
	//Mutator
	
	public function getFullNameAttribute(){
        $tipo_contacto = $this->attributes['typecontact_id'];
        if ($tipo_contacto == 2) {
            $nombre_contacto = $this->attributes['nombre'] . " " . $this->attributes['apellido'] . " (Inquilino)";
        } else { 
            $nombre_contacto = $this->attributes['nombre'] . " " . $this->attributes['apellido'];
        }
		return $nombre_contacto;
	}
	
}
