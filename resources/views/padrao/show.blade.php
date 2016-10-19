@extends('padrao.base')


@section('contentheader_title')
	Cadastro de {{ $meta_aplicacao->nomeRecurso() }}

	<a
		class="pull-right btn btn-primary"
		href="{{ action("{$meta_aplicacao->nomeController()}@index") }}">
			<i class="fa fa-arrow-left"></i> Retornar para Lista
	</a>
@endsection

@section('titulo-caixa')
	<a class="btn-link"
		href="{{ action("{$meta_aplicacao->dslRotaCorrente()}", $model['id']) }}">
		<i class="fa fa-list"></i> Detalhes
	</a>
@endsection

@section('conteudo-caixa')

	@foreach($meta_recurso->camposAcao() as $campo)
  			{!! 
  				Form::texto($campo, $model, [
  					'disabled' => 'disabled',
  				]) 
  			!!}
    @endforeach
    <div class="pull-right">
    	@include('parciais.html.botoes.voltar', [
    		'texto' => 'Voltar',
    		'link' => action("{$meta_aplicacao->nomeController()}@index")
    	])

    	@include('parciais.html.botoes.imprimir', [
    		'texto' => 'Imprimir'
    	])

    	@include('parciais.html.botoes.novo-registro', [
    		'texto' => 'Criar Novo Registro',
    		'link' => action("{$meta_aplicacao->nomeController()}@create")
    	])
    </div>

@endsection