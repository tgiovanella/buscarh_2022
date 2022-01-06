@extends('admin.layouts.app')

@section('title',__('Solicitaçãode Propriedade'))



@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">@yield('title')</h3>
                <div class="box-tools pull-right">

                    @history(['auditable_id' => $claim->id, 'auditable_type' => 'App\Claim'])
                    {{-- Botão History  --}}
                    @endhistory

                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Dados do Solicitante</h4>
                        <div class="card">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>Nome: </strong>{{ $claim->id}}</li>
                                <li class="list-group-item"><strong>Nome: </strong>{{ $claim->user_id}}</li>
                                <li class="list-group-item"><strong>Nome: </strong>{{ $claim->name }}</li>
                                <li class="list-group-item"><strong>Nome: </strong>{{ $claim->cpf }}</li>
                                <li class="list-group-item"><strong>Nome: </strong>{{ $claim->rg_cnh }}</li>
                            </ul>
                        </div>


                    </div>

                    <div class="col-md-6">
                        <h4>Empresa Reividicada</h4>
                        <div class="card">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>Nome: </strong>{{ $claim->company}}</li>
                                <li class="list-group-item"><strong>Nome: </strong>{{ $claim->cnpj}}</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- /.row -->

                <div class="row">
                    <div class="col-md-12">
                        <h3>Empresas Localizadas</h3>
                        <p class="text-muted">As empresas são filtradas com base no CNPJ e RAZÃO SOCIAL informado pelo
                            solicitante da propriedade.</p>
                        <form class="form form-search" method="GET" action="">
                            <strong>Filtros</strong>
                            <div class="row">


                                <div class="form-group col-md-3">
                                    <label class="sr-only" for="name">Descrição</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $name }}"
                                        placeholder="Descrição">
                                </div>

                                <div class="form-group col-md-3">
                                    <label class="sr-only" for="name">CPF ou CNPJ</label>
                                    <input type="text" class="form-control" id="cpf_cnpj" name="cpf_cnpj"
                                        value="{{ $cpf_cnpj }}" placeholder="CPF/CNPJ">
                                </div>


                                <div class="col-md-6 text-right">
                                    <button type="submit" class="btn btn-success">Buscar</button>
                                    <a href="{{ route('admin.claims.show',$claim) }}" class="btn btn-warning">Limpar</a>
                                </div>

                            </div>


                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th>CPF/CNPJ</th>
                                    <th>Email</th>
                                    <th>Categorias</th>
                                    <th class="">Cidade/UF</th>
                                    <th class="">Dono (usuário)</th>
                                    <th class="text-center">Destaque</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center" style="width: 10%">Ação</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($companies as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->cpf_cnpj }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td width="20%" class="small">
                                        @forelse($item->subcategories as $category)
                                        <span class="label label-default">{{ $category->category->name }}:
                                            {{ $category->name }}</span>
                                        @empty
                                        Não vinculado
                                        @endforelse
                                    </td>
                                    <td>{{ @$item->city->title }}/{{ @$item->city->state->letter }}</td>
                                    <td><a href="#">{{ @$item->owner->name }}</a></td>
                                    <td class="text-center">
                                        {!! status($item->highlighted ) !!}
                                    </td>
                                    <td class="text-center">
                                        {!! status( $item->status ) !!}
                                    </td>
                                    <td class="text-center">
                                        @actions(['item'=>$item, 'route' => 'companies','btns' => 'edit'])
                                        {{-- botão de ação --}}
                                        @endactions()
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5">
                                        {{ __('Não foi localizado nenhuma empresa com o CNPJ ou Razão Social informado. Tente aplicar outros filtros.')}}
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- ./box-body -->
            <div class="box-footer">
                <!-- /.row -->
            </div>
            <!-- /.box-footer -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>



@endsection
