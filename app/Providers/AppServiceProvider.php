<?php

namespace App\Providers;

use App\Facades\ProjectServiceFacade;
use App\Facades\TaskServiceFacade;
use App\Services\ProjectService;
use App\Services\TaskService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Bind TaskService
        App::bind('TaskService', function () {
            return new TaskServiceFacade();
        });

        // Bind ProjectService
        App::bind('ProjectService', function () {
            return new ProjectServiceFacade();
        });

        // Bind services for dependency injection
        $this->app->singleton(TaskService::class, TaskService::class);
        $this->app->singleton(ProjectService::class, ProjectService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
