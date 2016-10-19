{!! Form::text($name, $value, array_merge($attributes, [
		'data-mask' => '',
		'data-inputmask' => "'alias': 'dd/mm/yyyy'",
		'data-type' => 'mascara-data'
	])) !!}