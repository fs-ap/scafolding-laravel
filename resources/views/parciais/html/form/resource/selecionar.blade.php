<div class="form-group">
	<label for="{{ $name }}">
		{{ $meta_recurso->getRotuloPara($name) }}
	</label>

		{!! View::make('parciais.html.form.select', [
			'name' => $name,
			'options' => $meta_recurso->getOptionsParaSelect($name),
			'value' => $model[$name]
	])->render() !!}
</div>