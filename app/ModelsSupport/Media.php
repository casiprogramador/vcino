<?php

namespace App\ModelsSupport;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Media
 * @package App\ModelsSupport
 * @version September 24, 2016, 12:58 am UTC
 */
class Media extends Model
{
    use SoftDeletes;

    public $table = 'media';
    

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
        return $this->hasMany('App\Contact','media_id');
    }
}
