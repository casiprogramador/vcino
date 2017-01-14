<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function collection()
    {
        return $this->belongsTo('App\Collection');
    }
}
