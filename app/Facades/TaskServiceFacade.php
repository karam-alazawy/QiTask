<?php

namespace App\Facades;

use App\Services\TaskService;
use Illuminate\Support\Facades\Facade;

class TaskServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return TaskService::class;
    }
}
