<?php

namespace App\Repositories;

use App\ModelsSupport\SituacionHabitacional;
use InfyOm\Generator\Common\BaseRepository;

class SituacionHabitacionalRepository extends BaseRepository
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
        return SituacionHabitacional::class;
    }
}
