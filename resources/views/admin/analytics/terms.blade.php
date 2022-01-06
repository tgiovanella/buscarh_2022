@extends('admin.layouts.app')

@section('title',__('Termos Pesquisados'))



@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">@yield('title')</h3>
                <div class="box-tools pull-right">
                <a class="btn btn-xs btn-primary" href="{{ url(route('admin.analytics.terms-export')) }}" role="button">
                    Exportar <i class="fa fa-file-excel-o" aria-hidden="true"></i></a>
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
                                    <label class="sr-only" for="name">Termos</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name',request('name')) }}" placeholder="Descrição">
                                </div>

                                <div class="col-md-9 text-right">
                                    <button type="submit" class="btn btn-success">Buscar</button>
                                    <a href="{{ route('admin.analytics.terms') }}" class="btn btn-warning">Limpar</a>
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
                                    <th>Data</th>
                                    <th>Termo</th>
                                    <th>Plataforma</th>
                                    <th>Browser</th>
                                    <th>Móbile</th>
                                    <th>Device</th>
                                    <th>IP</th>
                                    <th>Usuário</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($analytics as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->term }}</td>
                                    <td>{{ $item->platform }}</td>
                                    <td>{{ $item->browser }}</td>
                                    <td>{{ !$item->is_desktop ? 'SIM' : 'NÃO' }}</td>
                                    <td>{{ $item->device }}</td>
                                    <td>{{ $item->remote_addr }}</td>
                                    <td>{{ $item->user_id }}</td>
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
                    <div class="col-md-4 text-left">{{ $analytics->links() }}</div>
                    <div class="col-md-7 text-right paginate-count">{!! info_pages($analytics) !!}</div>
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
