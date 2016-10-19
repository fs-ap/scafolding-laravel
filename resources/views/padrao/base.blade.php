@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ $meta_aplicacao->nomeRecurso() }}

@endsection

@section('contentheader_title')
	Cadastro de {{ $meta_aplicacao->nomeRecurso() }}
@endsection

@section('main-content')
	<div class="row">
        <div class="col-xs-12">
          	<div class="box">
          		<div class="box-header">
					<h3 class="box-title">
						@yield('titulo-caixa')
					</h3>
					<div class="box-tools">
						@yield('botoes-caixa')
					</div>
				</div>
				<div class="box-body">
					@yield('conteudo-caixa')
            	</div>
            	<div class="box-footer">
            		@yield('footer-caixa')
            	</div>
           	</div>
        </div>
	</div>
@endsection