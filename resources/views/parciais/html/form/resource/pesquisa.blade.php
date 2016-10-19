{!!
	View::make("parciais.html.form.resource.{$meta_recurso->getTipoCampoPara($name)}", [
		'name' => $name,
		'model' => [$name => $value],
		'attributes' => ['data-advanced-search' => '']
	]);
!!}