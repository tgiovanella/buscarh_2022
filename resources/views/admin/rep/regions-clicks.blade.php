@extends('admin.layouts.app')

@section('title',__('Relatório de Cliques e Regiões'))



@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">@yield('title')</h3>
                <div class="box-tools pull-right">
                    {{-- <a class="btn btn-xs btn-primary" href="{{ url(route('admin.report.contacts.exp')) }}" role="button">
                        Exportar <i class="fa fa-file-excel-o" aria-hidden="true"></i></a> --}}
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
                                    <a href="{{ route('admin.clicks-regions.show', $uf) }}" class="btn btn-warning">Limpar</a>
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
                                    <th>Empresa</th>
                                    <th>Região</th>
                                    <th class="text-right">Total de Cliques</th>
                                    <th class="text-right"></th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($clicks as $item)
                                <tr>
                                    <td>{{ $item->company_name }}</td>
                                    <td>{{ $item->letter_state }}</td>
                                    <td class="text-right">{{ $item->count }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('admin.clicks-regions.details',$item->company_id) }}" class="btn btn-xs btn-default bg-gray" alt="Detalhes"><i
                                            class="fa fa-table"></i></a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3">
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
                    <div class="col-md-4 text-left"></div>
                    <div class="col-md-7 text-right paginate-count"></div>
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
