<?php

namespace App\ModelsSupport;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Typecontact
 * @package App\ModelsSupport
 * @version September 23, 2016, 10:56 pm UTC
 */
class Typecontact extends Model
{
    use SoftDeletes;

    public $table = 'typecontacts';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'nombre',
        'activa'
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

    public function contact()
    {
        return $this->hasMany('App\Contact','typecontact_id');
    }
}
