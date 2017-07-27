<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskRequest extends Model
{
  public function task()
  {
    return $this->belongsTo('App\Task');
  }
  
  public function property()
  {
    return $this->belongsTo('App\Property');
  }
  
  public function contact()
  {
    return $this->belongsTo('App\Contact');
  }
}
