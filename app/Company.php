<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function account()
    {
        return $this->hasMany('App\Account');
    }

    public function category()
    {
        return $this->hasMany('App\Category');
    }

    public function supplier()
    {
        return $this->hasMany('App\Supplier');
    }

    public function quota()
    {
        return $this->hasMany('App\Quota');
    }

    public function equipment()
    {
        return $this->hasMany('App\Equipment');
    }

    public function installation()
    {
        return $this->hasMany('App\Installation');
    }

    public function receiptnumber()
    {
        return $this->hasMany('App\ReceiptNumber');
    }

    public function phonesite()
    {
        return $this->hasMany('App\Phonesite');
    }
	
	public function comunication()
    {
        return $this->hasMany('App\Communication');
    }
}
