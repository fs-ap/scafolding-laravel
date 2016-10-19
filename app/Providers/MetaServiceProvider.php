<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\MetaAplicacao;
use App\MetaRecurso;

class MetaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $app = $this->app;

        $app->bind('metadata', function($app){
            return new MetaAplicacao($app['router'], $app['request']);
        });

        $app->bind('metadata_recurso', function($app){
            $controller = $app->make('metadata')->nomeController();
            
            $caminhoMeta = sprintf('views/%s/%s', mb_strtolower($controller::$pluralName), 'meta.json');

            $json = json_decode(file_get_contents(resource_path($caminhoMeta)), true);
            
            if(is_null($json)) {
                throw new \Exception("JSON INVÁLIDO EM: " . resource_path($caminhoMeta), 1);
                
            }
            return new MetaRecurso($json);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
