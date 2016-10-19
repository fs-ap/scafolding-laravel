<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Form;

class FormServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Form::component('texto', 'parciais.html.form.resource.texto', [
            'name',
            'model',
            'attributes' => []
        ]);

        Form::component('data', 'parciais.html.form.resource.data', [
            'name',
            'model',
            'attributes' => []
        ]);

        Form::component('pesquisa', 'parciais.html.form.resource.pesquisa', [
            'name',
            'value' => '',
            'attributes' => []
        ]);

        Form::component('foreign', 'parciais.html.form.resource.foreign', [
            'name',
            'model',
            'attributes' => []
        ]);

        Form::component('selecionar', 'parciais.html.form.resource.selecionar', [
            'name',
            'model',
            'attributes' => []
        ]);
    }
}
