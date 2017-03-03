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
	
	public function expenses()
    {
        return $this->hasMany('App\Expenses');
    }
	
	public function origen(){
		return $this->hasMany('App\Transfer', 'ori_account_id');
	}
	
	public function destino(){
		return $this->hasMany('App\Transfer', 'des_account_id');
	}
}
