<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(app('request')->has('busca_avancada')) {
            $this->app->bind('Prettus\Repository\Criteria\RequestCriteria',
            'App\Criterias\AvancadoRequestCriteria');
        } else {
            $this->app->bind('Prettus\Repository\Criteria\RequestCriteria',
            'App\Criterias\SimplesRequestCriteria');
        }

        $this->app->bind('App\Criterias\Factory\FactoryConditionInterface', function(){
            return new \App\Criterias\Factory\FactoryCondition();
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
