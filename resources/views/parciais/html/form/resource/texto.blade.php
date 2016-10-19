<div class="form-group">
	<label
		for="{{$name}}">
			{{ $meta_recurso->getRotuloPara($name) }}
	</label>

	{!! View::make('parciais.html.form.texto', [
		'name' => $name,
		'value' => $meta_recurso->getValorCampo($name, $model),
		'attributes' => array_merge($attributes, ['class' => 'form-control', 'id' => $name])
	])->render() !!}
	
</div>