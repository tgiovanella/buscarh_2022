<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;



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
        Schema::defaultStringLength(191);

        //register alias components blade
        Blade::component('user.components.alert', 'alert');

        //register alias para componente de serach principal
        Blade::component('user.components.search_main', 'search_main');


        Blade::component('admin.components.actions', 'actions');


        Blade::component('admin.components.history', 'history');

        if(\App::environment() === 'production') {
            $this->app['request']->server->set('HTTPS', true);
            URL::forceScheme('https');
        }

    }
}
