<?php

namespace App\Providers;

use App\QuoteCandidateNotification;
use App\User;
use Illuminate\Support\Facades\Auth;
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

        if (\App::environment() === 'production') {
            $this->app['request']->server->set('HTTPS', true);
            URL::forceScheme('https');
        }

        //Exibe o contador nas notificações no navbar
        view()->composer('user.layouts.html', function ($view) {
            $count_notification = 0;
            if ($user =  Auth::user()) {
                $candidate = User::where('id', $user->id)->whereHas('companies')->with('companies')->first();
                //Valida se existe companies cadastradas para o usuário.
                $count_notification = $candidate ? QuoteCandidateNotification::whereIn('company_id', $candidate->companies->pluck('id'))->count() : 0;
            }
            $view->with('notification', $count_notification);
        });
    }
}
