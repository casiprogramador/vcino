<?php

namespace App\Repositories;

use App\ModelsSupport\Tvservice;
use InfyOm\Generator\Common\BaseRepository;

class TvserviceRepository extends BaseRepository
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
        return Tvservice::class;
    }
}
