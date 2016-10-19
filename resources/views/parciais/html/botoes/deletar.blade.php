<form action="{{$acao}}" method="POST" class="form-delete">
    <input type="hidden" name="_method" value="DELETE">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <button class="btn btn-danger btn-flat form-btn-delete">
    <i class="fa fa-trash"></i> Deletar</button>
</form>