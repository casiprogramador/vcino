<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function account()
    {
        return $this->belongsTo('App\Account');
    }
	
    public function property()
    {
        return $this->belongsTo('App\Property');
    }
	
    public function contact()
    {
        return $this->belongsTo('App\Contact');
    }
	
    public function transaction()
    {
        return $this->belongsTo('App\Transaction');
    }
}
