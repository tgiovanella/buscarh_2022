@if(count($user->quotations))
<div class="row">
    <div class="col">
        <button onclick="openModalQuotForm(event)" class="btn btn-primary mb-3 pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i>
            Cadastrar</button>
    </div>
</div>

<table class="table table-striped table-hover table-sm">
    <thead>
        <tr>
            <th>#</th>
            <th>Titulo</th>
            <th>Categoria</th>
            <th>Cidades</th>
            <th>UFs</th>
            <th>Cotações</th>
            <th class="text-center">Ação</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($user->quotations as $item)
        <tr>
            <td>{{ $item->title }}</td>
            <td>
                @foreach($item->categories as $cat)

                @endforeach
            </td>
            <td>
                @foreach($item->cities as $city)

                @endforeach
            </td>
            <td>
                @foreach($item->states as $uf)

                @endforeach
            </td>
            <td>{{$item->count_interested}}</td>
            <td class="text-center">
                <a href="#" class="btn btn-sm btn-secondary" title="Encerrar Cotação"><i class="fa fa-close" aria-hidden="true"></i></a>
                <a href="#" class="btn btn-sm btn-danger" title="Apagar Cotação"><i class="fa fa-trash" aria-hidden="true"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<div class="alert alert-primary" role="alert">
    Criar nova Cotação <a href="#" onclick="openModalQuotForm(event)" class="alert-link">Clique aqui</a>
</div>
@endif