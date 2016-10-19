<!-- Main Footer -->
<footer class="main-footer">
    	<strong>
    		PRODAP - PROCESSAMENTO DE DADOS DO ESTADO DO AMAPÁ &copy; 2016
    		<a href="http://www.prodap.ap.gov.br">www.prodap.ap.gov.br</a>.
    	</strong>

    	<div class="pull-right hidden-xs">
        	<div title="{{ Auth::user()->id }}" class="label label-primary margin">
        		USUÁRIO: {{ mb_strtoupper( Auth::user()->name ) }}
        	</div>
        	<div title="{{ Session::get('multitenant_tenant')->id }}" class="label label-primary">
        		UNIDADE: {{ mb_strtoupper( Session::get('multitenant_tenant')->name ) }}
        	</div>
    	</div>
</footer>