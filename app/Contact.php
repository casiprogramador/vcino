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
	
}
