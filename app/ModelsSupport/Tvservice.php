<?php

namespace App\ModelsSupport;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Tvservice
 * @package App\ModelsSupport
 * @version September 16, 2016, 2:46 am UTC
 */
class Tvservice extends Model
{
    use SoftDeletes;

    public $table = 'tvservices';
    

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
