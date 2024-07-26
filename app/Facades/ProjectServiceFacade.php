<?php

namespace App\Facades;

use App\Services\ProjectService;
use Illuminate\Support\Facades\Facade;

class ProjectServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ProjectService::class;
    }
}
