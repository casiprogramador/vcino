<?php

namespace App\ModelsSupport;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Internetservice
 * @package App\ModelsSupport
 * @version September 16, 2016, 3:24 am UTC
 */
class Internetservice extends Model
{
    use SoftDeletes;

    public $table = 'internetservices';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'nombre'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nombre' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required'
    ];

    public function property()
    {
        return $this->hasMany('App\Property');
    }
}
