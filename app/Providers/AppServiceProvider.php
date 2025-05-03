<?php

namespace App\Providers;

use App\Services\StudentService;
use DateFormatService;
use Filament\Facades\Filament;
use Filament\Navigation\NavigationItem;
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
        Filament::registerNavigationItems([
            NavigationItem::make('Generiraj PDF (prošli mjesec)')
                ->url('/pdf', shouldOpenInNewTab: true)
                ->icon('heroicon-o-presentation-chart-line')
                ->activeIcon('heroicon-s-presentation-chart-line')
                ->sort(5),
            NavigationItem::make('Generiraj PDF (trenutni mjesec)')
                ->url('/current-pdf', shouldOpenInNewTab: true)
                ->icon('heroicon-o-presentation-chart-line')
                ->activeIcon('heroicon-s-presentation-chart-line')
                ->sort(6),
        ]);
    }
}
