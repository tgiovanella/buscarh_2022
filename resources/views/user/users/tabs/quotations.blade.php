@if(count($user->quotations))
<div class="row">
    <div class="col">
        <a href="{{ route('user.users.company') }}" class="btn btn-primary mb-3 pull-right"><i class="fa fa-plus-circle"
                aria-hidden="true"></i>
            Cadastrar</a>
    </div>
</div>

<table class="table table-striped table-hover table-sm">
    <thead>
        <tr>
            <th>Nome</th>
            <th>CNPJ/CPF</th>
            <th>Cidade/UF</th>
            <th>Telefone</th>
            <th class="text-center">Ação</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($user->quotations as $item)
        <tr>
            <td>{{ $item->name }}</td>
            <td>{{ $item->cpf_cnpj }}</td>
            <td>{{ @$item->city->title }}/{{ @$item->city->state->letter }}</td>
            <td>{{ $item->phone }}</td>
            <td class="text-center">

                @actions(['item'=>$item, 'user' => true, 'route' => 'user.users.company','btns' => 'edit|delete'])
                {{-- botão de ação --}}
                @endactions()

                {{-- <a href="{{ route('user.users.company.edit',$item) }}" class="btn btn-sm btn-dark"><i
                    class="fa fa-pencil" aria-hidden="true"></i></a>
                <a href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a> --}}
            </td>
        </tr>
        @endforeach

    </tbody>
</table>
@else
<div class="alert alert-primary" role="alert">
    Criar nova Cotação <a href="{{ route('user.users.company') }}" class="alert-link">Clique aqui</a>
</div>
@endif
