<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceiptNumber extends Model
{
    public function company()
    {
        return $this->belongsTo('App\Company');
    }
}
