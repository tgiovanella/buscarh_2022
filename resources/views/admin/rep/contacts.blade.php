@extends('admin.layouts.app')

@section('title',__('Relatório de Contatos por Empresa'))



@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">@yield('title')</h3>
                <div class="box-tools pull-right">
                    <a class="btn btn-xs btn-primary" href="{{ url(route('admin.report.contacts.exp')) }}" role="button">
                        Exportar <i class="fa fa-file-excel-o" aria-hidden="true"></i></a>
                    </div>
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
                                    <label class="sr-only" for="name">Nome</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name',request('name')) }}" placeholder="Nome da Empresa">
                                </div>

                                <div class="col-md-9 text-right">
                                    <button type="submit" class="btn btn-success">Buscar</button>
                                    <a href="{{ route('admin.pages.index') }}" class="btn btn-warning">Limpar</a>
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
                                    <th>Empresa</th>
                                    <th>CPF/CNPJ</th>
                                    <th>Responsavel</th>
                                    <th>Email</th>

                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($companies as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->cpf_cnpj }}</td>
                                    <td>{{ $item->responsible }}</td>
                                    <td>{{ $item->email }}</td>
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
