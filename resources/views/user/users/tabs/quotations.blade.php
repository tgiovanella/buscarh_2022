@if(count($user->quotes) > 0)
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
            <th>Candidatos</th>
            <th class="text-center">Ação</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($user->quotes as $item)
        <tr>
            <td width="80">{{ $item->id }}</td>
            <td width="20%">{{ $item->title }}</td>
            <td class="small">
                @foreach($item->subcategories as $category)
                <span class="label label-default">{{ $category->category->name }}:{{ $category->name }}</span>
                @endforeach
            </td>
            <td>
                @foreach($item->cities as $city)
                <span class="label label-default">{{ $city->title }}</span>
                @endforeach
            </td>
            <td width="80" class="text-center">{{$item->candidates_count}}</td>
            <td width="120" class="text-center">
                <a href="{{route('user.candidate',[$item->id])}}" class="btn btn-sm btn-info text-white" title="Visualizar Candidatos"><i class="fa fa-eye" aria-hidden="true"></i></a>
                <a href="#" class="btn btn-sm btn-secondary" title="Encerrar Cotação"><i class="fa fa-close" aria-hidden="true"></i></a>
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