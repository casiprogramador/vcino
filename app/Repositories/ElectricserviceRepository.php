<?php

namespace App\Repositories;

use App\ModelsSupport\Electricservice;
use InfyOm\Generator\Common\BaseRepository;

class ElectricserviceRepository extends BaseRepository
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
        return Electricservice::class;
    }
}
