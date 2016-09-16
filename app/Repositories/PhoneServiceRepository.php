<?php

namespace App\Repositories;

use App\ModelsSupport\PhoneService;
use InfyOm\Generator\Common\BaseRepository;

class PhoneServiceRepository extends BaseRepository
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
        return PhoneService::class;
    }
}
