@extends('padrao.base')
@section('titulo-caixa') 
	<a href="{{ action($meta_aplicacao->dslRotaCorrente()) }}">
		Lista de {{ $meta_aplicacao->nomeRecurso() }}
	</a>
@endsection
@section('botoes-caixa')
	<a href="{{ action("{$meta_aplicacao->nomeController()}@create") }}" class="btn btn-success btn-sm">
		<i class="fa fa-plus-circle"></i>
		Cadastrar novo
	</a>
	<a href="#" class="btn btn-filtro-avancado btn-default btn-sm">
		<i class="fa fa-filter"></i>
		Filtros Avançados @if(Request::get('busca_avancada')) (Ativo) @endif
	</a>
	@if(Request::get('busca_avancada'))
		<a href="{{ action($meta_aplicacao->dslRotaCorrente()) }}" class="btn btn-danger btn-sm">
			<i class="fa fa-times"></i> Remover Filtros 
		</a>
	@endif
	<form style="display:inline;"  class="form-inline" action="{{ action($meta_aplicacao->dslRotaCorrente()) }}">
		<div class="input-group input-group-sm" style="width: 250px;">
			<input 
				type="text"
				name="search"
				value="{{ Request::has('search') && !Request::has('busca_avancada') ? Request::get('search') : '' }}"
				class="form-control pull-right"
				placeholder="Busca rápida de {{ $meta_aplicacao->nomeRecurso() }}...">

					<input type="hidden" name="filter[]" value="id">
				@foreach($meta_recurso->camposBuscaSimples() as $campo)
					<input type="hidden" name="filter[]" value="{{$campo}}">
          		@endforeach

          		<input type="hidden" name="searchFields" value="{{$meta_recurso->searchFields()}}">
			<div class="input-group-btn">
				@if(Request::has('search') && !Request::has('busca_avancada'))
					<a href="{{ action($meta_aplicacao->dslRotaCorrente()) }}" class="btn btn-default">
						<i class="fa fa-times"></i>
					</a>
				@endif
					<button type="submit" class="btn btn-default">
						<i class="fa fa-search"></i>
					</button>
			</div>
		</div>
		<button type="button" class="btn btn-sm btn-default" data-html="true"  data-container="body" data-toggle="popover" data-placement="bottom" data-content="Filtros aplicados para:
			@foreach($meta_recurso->camposAcao('index') as $campo)
				<br/> {{ $meta_recurso->getRotuloPara($campo) }}
			@endforeach 
		">
  				<i class="fa fa-question"></i>
			</button>
	</form>
	<div class="modal modal-filtro-avancado">
		<div class="modal-dialog">
			<div class="modal-content">
				<form class="form-busca-avancada" method="GET" action="{{ action($meta_aplicacao->dslRotaCorrente()) }}?searchFields={{ $meta_recurso->searchFields('avancada', 'todos') }}
					&filter[]=id
				@foreach($meta_recurso->camposAcao('todos') as $campo)
					&filter[]={{ $campo }}
				@endforeach">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
						<h4 class="modal-title">
							<span class="fa-stack">
							  <i class="fa fa-square-o fa-stack-2x"></i>
							  <i class="fa fa-filter fa-stack-1x"></i>
							</span>
							Filtro Avançado de {{ $meta_aplicacao->nomeRecurso() }}
						</h4>
					</div>
					<div class="modal-body">

						<input type="hidden" name="busca_avancada" value="true"/>
						@foreach($meta_recurso->camposAcao('todos') as $campo)
			                {!!
			                    app('form')->pesquisa($campo, Request::get($campo, Request::get($campo)));
			                !!}
	        			@endforeach

					</div>
					<div class="modal-footer">
						<button type="reset" class="btn btn-default pull-left" data-dismiss="modal">
							<i class="fa fa-times"></i> Fechar
						</button>
						<button type="reset" class="btn btn-default">
							<i class="fa fa-eraser"></i> Limpar
						</button>
						<button type="submit" class="btn btn-success">
							<i class="fa fa-search"></i> Buscar
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection

@section('conteudo-caixa')
	<table class="table table-striped table-bordered table-hover">
	  	<thead>
	  		<tr>
	      			@include('parciais.html.tabela.th', [
	      				'texto' => '#'
	      			])
	      		@foreach($meta_recurso->camposAcao() as $campo)

	      			@include('parciais.html.tabela.th', [
	      				'texto' => $meta_recurso->getRotuloPara($campo)
	      			])

	      		@endforeach
	      		<th class="no-sort" width="35%">Ações</th>
	    	</tr>
	  	</thead>
	    <tbody>
	    	
	        @foreach($models['data'] as $model)
	        	<tr>
	        		@include('parciais.html.tabela.td', [
	          				'texto' => $loop->iteration
	          			])
	        		@foreach($meta_recurso->camposAcao() as $campo)

	          			@include('parciais.html.tabela.td', [
	          				'texto' => $meta_recurso->getValorCampo($campo, $model)
	          			])

	      			@endforeach

	      			<td class="text-center">

	          				@include('parciais.html.botoes.visualizar', [
	          					'acao' => action("{$meta_aplicacao->nomeController()}@show", $model['id'])
	          				])
	          				@include('parciais.html.botoes.edit',[
	          					'acao' => action("{$meta_aplicacao->nomeController()}@edit", $model['id'])
	          				])
	          				@include('parciais.html.botoes.deletar', [
	          					'acao' => action("{$meta_aplicacao->nomeController()}@destroy", $model['id'])
	          				])
	      			</td>
	            </tr>
	        @endforeach
	  	</tbody>
	</table>

	@section('paginate')
		@include('vendor.pagination.my-paginate',['paginator' => $models['meta']['pagination']])
	@show

@endsection

@section('footer-caixa')
	<div class="pull-right">
		<span class="label label-info">
			Total de {{ $meta_aplicacao->nomeRecurso() }}: {{ $models['meta']['pagination']['total'] }}
		</span>
		&nbsp;&nbsp;
		<span class="label label-info">
			Registros por Página: {{ $models['meta']['pagination']['per_page'] }}
		</span>
	</div>
@endsection

@push('scripts-adicionais')
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			  $('[data-toggle="popover"]').popover()
			$('.btn-filtro-avancado').click(function(event) {
				event.preventDefault();
				$('.modal-filtro-avancado').modal();
			});

			$('.form-busca-avancada').submit(function(event) {
				event.preventDefault();

				var req = [];

				$($(this).serializeArray()).each(function(index, el) {
					if(el['value'] != '' && el['name'] != 'busca_avancada') {
						req.push(el['name'] + ':' + el['value']);
					}
				});

				var url = $(this).attr('action') +'&search='+ encodeURI(req.join(';') + '' +'&'+ unescape($(this).serialize()));

				console.log(req);
				window.location = url;
			});

		});
	</script>
@endpush