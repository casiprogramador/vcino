<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    public function transaction()
    {
        return $this->belongsTo('App\Transaction');
    }
	
	public function supplier()
    {
        return $this->belongsTo('App\Supplier');
    }
	
	public function category()
    {
        return $this->belongsTo('App\Category');
    }
	
	public function account()
    {
        return $this->belongsTo('App\Account');
    }
	
}
