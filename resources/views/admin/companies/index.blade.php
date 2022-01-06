@extends('admin.layouts.app')

@section('title',__('Empresas'))



@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">@yield('title')</h3>
                <div class="box-tools pull-right">
                    <a href="{{ route('admin.companies.create') }}" class="btn btn-sm btn-primary"><i
                            class="fa fa-plus-circle" aria-hidden="true"></i> Cadastrar</a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">


                <div class="row">
                    <div class="col-md-12">
                        <form class="form form-search" method="GET" action="">
                            <strong>Filtros</strong>
                            <div class="row">


                                <div class="form-group col-md-3">
                                    <label class="sr-only" for="name">Descrição</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name',request('name')) }}" placeholder="Descrição">
                                </div>

                                <div class="form-group col-md-3">
                                    <label class="sr-only" for="name">CPF ou CNPJ</label>
                                    <input type="text" class="form-control" id="cpf_cnpj" name="cpf_cnpj"
                                        value="{{ old('cpf_cnpj',request('cpf_cnpj')) }}" placeholder="CPF/CNPJ">
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="sr-only" for="name">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email',request('email')) }}" placeholder="Email">
                                </div>

                                <div class="col-md-2 text-right">
                                    <button type="submit" class="btn btn-success">Buscar</button>
                                    <a href="{{ route('admin.companies.index') }}" class="btn btn-warning">Limpar</a>
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
                                        @actions(['item'=>$item, 'route' => 'companies','btns' => 'show|edit|delete'])
                                        {{-- botão de ação --}}
                                        @endactions()
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5">
                                        {{ __('general.msg_not_register')}}
                                    </td>
                                </tr>
                                @endforelse


                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- ./box-body -->
            <div class="box-footer">
                <div class="row">
                    <div class="col-md-4 text-left">{{ $companies->links() }}</div>
                    <div class="col-md-7 text-right paginate-count">{!! info_pages($companies) !!}</div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-footer -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>



@endsection
