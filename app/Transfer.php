<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    public function accountOrigin(){
		return $this->belongsTo('App\Account', 'ori_account_id');
	}
	
	public function accountDestiny(){
		return $this->belongsTo('App\Account', 'des_account_id');
	}
	
	public function transactionOrigin()
    {
        return $this->belongsTo('App\Transaction','ori_transaction_id');
    }
	
	public function transactionDestiny()
    {
        return $this->belongsTo('App\Transaction','des_transaction_id');
    }
}
