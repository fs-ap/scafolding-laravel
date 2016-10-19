<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\MetaRecurso;
use App\Entities\Tenant;

class BaseController extends Controller
{
    public function __construct()
    {
    	$view = app('view');

    	if(php_sapi_name() != 'cli') {

	    	$view->share('meta_aplicacao', app()->make('metadata') );

	    	$view->share('meta_recurso', app()->make('metadata_recurso') );
    	}

    }
}
