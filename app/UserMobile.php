<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserMobile extends Authenticatable
{
	protected  $table = 'user_mobiles';


	protected $fillable = [
        'nombre','apellido', 'email', 'password','estado','api_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];
	
	public function company()
    {
        return $this->hasOne('App\Company');
    }
	
	public function property()
    {
        return $this->belongsTo('App\Property','property_id');
    }
	
	public function typecontact()
    {
        return $this->belongsTo('App\ModelsSupport\Typecontact','typecontact_id');
    }
}
