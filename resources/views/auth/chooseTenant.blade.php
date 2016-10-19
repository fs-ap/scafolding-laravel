@extends('adminlte::layouts.auth')

@section('htmlheader_title')
    Seleção Entidade
@endsection

@section('content')
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url('/home') }}"><b>Caixa</b>Escola</a>
        </div><!-- /.login-logo -->

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong>Ocorreram alguns problemas<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="login-box-body">
    <p class="login-box-msg"> Escolha a entidade que deseja entrar </p>
    <form action="{{ action('ChooseTenantController@store') }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group has-feedback">
            @include('parciais.html.form.select', [
                'name' => 'tenant_id',
                'value' => '',
                'options' => $tenants->pluck('name', 'id')
            ])
        </div>
        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary btn-block btn-flat">
                    <i class="fa fa-sign-in fa-lg fa-pull-left"></i> Entrar
                </button>

                <a href="/" class="btn btn-danger btn-block btn-flat">
                    <i class="fa fa-times fa-lg fa-pull-left"></i> Sair
                </a>
            </div><!-- /.col -->
        </div>
    </form>

</div><!-- /.login-box-body -->

</div><!-- /.login-box -->

    @include('adminlte::layouts.partials.scripts_auth')

    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
</body>

@endsection
