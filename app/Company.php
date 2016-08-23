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
}
