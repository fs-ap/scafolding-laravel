@if(\Session::has('message'))
<div class="alert 
	alert-{{(array_key_exists('type', \Session::get('message'))) ? \Session::get('message')['type'] :'success'}}
	alert-dismissible">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<h4><i class="icon fa fa-{{(array_key_exists('icon', \Session::get('message'))) ? \Session::get('message')['icon'] :'check'}}"></i> 
	{{(array_key_exists('title', \Session::get('message'))) ? \Session::get('message')['title'] :'Sucesso!'}}</h4>
	{{(array_key_exists('message', \Session::get('message'))) ? \Session::get('message')['message'] :'Alteração realizada com sucesso!'}}
</div>
@endif
