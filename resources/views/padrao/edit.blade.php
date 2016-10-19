@extends('padrao.base')


@section('contentheader_title')
	Cadastro de {{ $meta_aplicacao->nomeRecurso() }}

	<a
		class="pull-right btn btn-primary"
		href="{{ action("{$meta_aplicacao->nomeController()}@index") }}">
			<i class="fa fa-arrow-left"></i> Cancelar e Retornar para Lista
	</a>
@endsection

@section('titulo-caixa')
	<a class="btn-link"
		href="{{ action("{$meta_aplicacao->dslRotaCorrente()}", $model['id']) }}">
		<i class="fa fa-list"></i> Editar
	</a>
@endsection

@section('conteudo-caixa')
    <form id="form-principal" method="POST" action="{{ action("{$meta_aplicacao->nomeController()}@update", $model['id']) }}">
        {!! method_field('PUT') !!}
        {!! csrf_field() !!}
        
        @foreach($meta_recurso->camposAcao() as $campo)
                {!!
                    app('form')->{$meta_recurso->getTipoCampoPara($campo)}($campo, $model)
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

            <button type="submit" class="btn btn-success">
                <i class="fa fa-lg fa-check-circle"></i> Salvar edição
            </button>
        </div>
    </form>

@endsection

@push('scripts-adicionais')
    {!! $validacaoJS !!}
@endpush