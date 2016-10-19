<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Http\Middleware\AuthGuardMiddlewareInterface;
use App\Acl\Parser\ParserRouteInterface;
use App\Acl\Guard\Authorization\AuthorizationGuardInterface;

class GuardServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $app = $this->app;
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;

        
        $config = $app['config']->get('multitenant');

        $app->bind(AuthGuardMiddlewareInterface::class,
            $config['middlewares']['authorization']
        );

        $app->bind(ParserRouteInterface::class,
            $config['routes']['parser']
        );

        $app->bind(AuthorizationGuardInterface::class,
            $config['authorization']['guard']
        );

        $app->bind('multitenant', AuthGuardMiddlewareInterface::class);
    }
}
