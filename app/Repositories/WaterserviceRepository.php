<?php

namespace App\Repositories;

use App\ModelsSupport\Waterservice;
use InfyOm\Generator\Common\BaseRepository;

class WaterserviceRepository extends BaseRepository
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
        return Waterservice::class;
    }
}
