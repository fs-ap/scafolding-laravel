<div class="form-group">
	<label for="{{ $name }}">
		{{ $meta_recurso->getRotuloPara($name) }}
	</label>


	<div class="input-group">
		<div class="input-group-addon">
			<i class="fa fa-calendar"></i>
		</div>

		{!! View::make('parciais.html.form.data', [
			'name' => $name,
			'value' => isset($model[$name]) ? $model[$name] : null,
			'attributes' => array_merge(
				$attributes, [
					'class' => 'form-control', 'id' => $name
				]
			)
		])->render() !!}

	</div>

</div>