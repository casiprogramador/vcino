<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function collection()
    {
        return $this->hasOne('App\Collection');
    }
	
	public function expense()
    {
        return $this->hasOne('App\Expenses');
    }
	
	public function transfersOrigin()
    {
        return $this->hasMany('App\Transfer','ori_transaction_id');
    }
	
	public function transfersDestiny()
    {
        return $this->hasMany('App\Transfer','des_transaction_id');
    }
}
