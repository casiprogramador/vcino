<?php

namespace App\Repositories;

use App\ModelsSupport\Internetservice;
use InfyOm\Generator\Common\BaseRepository;

class InternetserviceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Internetservice::class;
    }
}
