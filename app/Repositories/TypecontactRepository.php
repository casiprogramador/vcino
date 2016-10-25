<?php

namespace App\Repositories;

use App\ModelsSupport\Typecontact;
use InfyOm\Generator\Common\BaseRepository;

class TypecontactRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'activa'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Typecontact::class;
    }
}
