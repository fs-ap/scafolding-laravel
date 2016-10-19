<?php

use Illuminate\Foundation\Inspiring;
use \Illuminate\Support\Str;
/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');


Artisan::command('make:crud {model}', function ($model) {

    $this->call("make:entity", ['name' => $model]);

    $rota = mb_strtolower(Str::slug(Str::plural($model), '_'));
    $controller = Str::plural($model);

    File::append(
    		base_path('routes/web.php'),
    		sprintf("\nRoute::resource('%s', '%s');\n", $rota, "{$controller}Controller")
    );

    File::copyDirectory(app_path('/Stubs/views/padrao'), resource_path(sprintf('views/%s', mb_strtolower(Str::plural($model)))));
    
})->describe('Cria um CRUD básico');


Artisan::command('remove:crud {model}', function ($model) {

	$config = Config::get('repository')['generator'];

	$basePath = $config['basePath'];
	$paths = $config['paths'];

	$rota = mb_strtolower(Str::slug(Str::plural($model), '_'));
    $controller = Str::plural($model);

	File::delete([
		"$basePath/{$paths['models']}/{$model}.php",
		"$basePath/{$paths['repositories']}/{$model}Repository.php",
		"$basePath/{$paths['repositories']}/{$model}RepositoryEloquent.php",
		"$basePath/{$paths['controllers']}/{$controller}Controller.php",
		"$basePath/{$paths['validators']}/{$model}Validator.php",
        "$basePath/{$paths['validators']}/{$model}Validator.php",
        "$basePath/{$paths['transformers']}/{$model}Transformer.php",
		"$basePath/{$paths['presenters']}/{$model}Presenter.php",
		app_path("Http/Requests/{$model}CreateRequest.php"),
		app_path("Http/Requests/{$model}UpdateRequest.php"),
	]);

    $rotas = File::get(base_path('routes/web.php'));

    $rotas = str_replace(sprintf("Route::resource('%s', '%s');\n", $rota, "{$controller}Controller"), '', $rotas);

    File::put(base_path('routes/web.php'), $rotas);

    $provedor = File::get(app_path('Providers/RepositoryServiceProvider.php'));

    $provedor = str_replace(sprintf('$this->app->bind(\App\Repositories\%sRepository::class, \App\Repositories\%sRepositoryEloquent::class);' . PHP_EOL, $model, $model), '', $provedor);

    File::put(app_path('Providers/RepositoryServiceProvider.php'), $provedor);


})->describe('Cria um CRUD básico');