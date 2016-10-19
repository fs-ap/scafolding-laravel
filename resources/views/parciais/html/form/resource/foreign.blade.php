<div class="form-group">
	<label for="{{ $name }}">
		{{ $meta_recurso->getRotuloPara($name) }}
	</label>

		{!! View::make('parciais.html.form.select', [
			'name' => $name,
			'options' => $meta_recurso->getOptionsParaForeign($name),
			'value' => $model[$name],
			'attributes' => array_merge(
				$attributes, [
					'class' => 'form-control', 'id' => $name
				]
			)
		])->render() !!}

</div>