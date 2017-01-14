<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function bank()
    {
        return $this->belongsTo('App\Bank');
    }
	
	public function collections()
    {
        return $this->hasMany('App\Collection');
    }
}
