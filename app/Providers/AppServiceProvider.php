<?php

namespace App\Providers;

use App\Services\StudentService;
use DateFormatService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(StudentService::class, function($app){
            return new StudentService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();
    }
}
