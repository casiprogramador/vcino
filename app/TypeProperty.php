<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeProperty extends Model
{
    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function quota()
    {
        return $this->hasMany('App\Quota');
    }
	
    public function property()
    {
        return $this->hasMany('App\Property');
    }
}
