<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function quota()
    {
        return $this->hasMany('App\Quota');
    }
	
	public function expenses()
    {
        return $this->hasMany('App\Expenses');
    }
}
