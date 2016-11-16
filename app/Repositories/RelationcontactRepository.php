<?php

namespace App\Repositories;

use App\ModelsSupport\Relationcontact;
use InfyOm\Generator\Common\BaseRepository;

class RelationcontactRepository extends BaseRepository
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
        return Relationcontact::class;
    }
}
