<?php

namespace App\Providers;

use App\UseCases\MenuGeneratorService;
use Illuminate\Support\ServiceProvider;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {

            $menu = MenuGeneratorService::generateMenu();

            $view->with('laravelAdminMenus', $menu);
        });
    }
}
