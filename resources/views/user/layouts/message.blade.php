@if(session('error'))
<div class="alert alert-danger alert-dismissible my-2 fade show" role="alert">
    <strong>Erro!</strong> {!! session('error') !!}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if(session('warning'))
<div class="alert alert-warning alert-dismissible my-2 fade show" role="alert">
    <strong>Alerta!</strong> {!! session('warning') !!}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if(session('success'))
<div class="alert alert-success alert-dismissible my-2 fade show" role="alert">
    <strong>Sucesso!</strong> {!! session('success') !!}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
