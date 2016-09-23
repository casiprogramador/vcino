<?php

namespace App\ModelsSupport;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SituacionHabitacional
 * @package App\ModelsSupport
 * @version September 15, 2016, 10:00 pm UTC
 */
class SituacionHabitacional extends Model
{
    use SoftDeletes;

    public $table = 'situacion_habitacionals';
    

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
        return $this->hasMany('App\Property','situacion_habitacionals_id');
    }
}
