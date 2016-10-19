@extends('padrao.base')

@section('titulo-caixa') 
	<a href="{{ action($meta_aplicacao->dslRotaCorrente()) }}">
		Criar {{ $meta_aplicacao->nomeRecurso() }}
	</a>
@endsection

@section('botoes-caixa')
	@include('parciais.html.botoes.voltar', [
		'texto' => 'Voltar',
		'link' => action("{$meta_aplicacao->nomeController()}@index")
	])

	<a
		onclick="document.getElementsByClassName('btn-limpar-form')[0].click()"
		href="#"
		class="btn btn-default btn-limpar-form">
		<i class="fa fa-refresh"></i> Limpar Formulário
	</a>

	<a
		onclick="document.getElementsByClassName('btn-salvar-form')[0].click()"
		href="#"
		class="btn btn-success">
		<i class="fa fa-check-circle"></i> Salvar
	</a>

	<a
		onclick="document.getElementsByClassName('salvar-cadastrar-novo')[0].click()"
		href="#"
		class="btn btn-success">
		<i class="fa fa-plus-circle"></i> Salvar e Criar Outro
	</a>

@endsection

@section('conteudo-caixa')
	<form id="form-principal" data-original-action="{{ action("{$meta_aplicacao->nomeController()}@store") }}" method="POST" action="{{ action("{$meta_aplicacao->nomeController()}@store") }}">
		{!! csrf_field() !!}
		@foreach($meta_recurso->camposAcao() as $campo)
	  			{!! 
	  				app('form')->{$meta_recurso->getTipoCampoPara($campo)}($campo)
	  			!!}
	    @endforeach
	    <div class="pull-right">
	    	@include('parciais.html.botoes.voltar', [
	    		'texto' => 'Voltar',
	    		'link' => action("{$meta_aplicacao->nomeController()}@index")
	    	])

	    	<a href="#" class="btn btn-default btn-limpar-form">
				<i class="fa fa-refresh"></i> Limpar Formulário
			</a>

	    	<button type="submit" class="btn btn-success btn-salvar-form">
	    		<i class="fa fa-check-circle"></i>
	    			Salvar
	    	</button>
	    	<button type="submit" class="btn btn-success salvar-cadastrar-novo">
	    		<i class="fa fa-plus-circle"></i>
	    			Salvar e Criar Outro
	    	</button>
	    </div>
    </form>
@endsection

@push('scripts-adicionais')
    {!! $validacaoJS !!}

	<script type="text/javascript">
		$('.salvar-cadastrar-novo').click(function(event) {
			$(this).attr('clicado', true);
		});

		$('form').submit(function(event) {
			var form = $(this);
			var action = form.attr('action', form.data('original-action'));

			$(this).find('[clicado="true"]').each(function(index, el) {
				if($(el).hasClass('salvar-cadastrar-novo')) {
					$(form).attr('action', form.attr('action') + '?cadastrarNovo=true');
				}
			});
		});

		$('.btn-limpar-form').click(function(event) {
			$('#form-principal')[0].reset();
		});

	</script>
@endpush