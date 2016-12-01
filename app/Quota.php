<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quota extends Model
{
    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function typeProperty()
    {
        return $this->belongsTo('App\TypeProperty');
    }
	
	public function accountsreceivable()
    {
        return $this->hasMany('App\Accountsreceivable');
    }
}
