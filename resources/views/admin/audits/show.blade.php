@extends('admin.layouts.app')

@section('title',__('Histórico de Alterações'))



@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">@yield('title')</h3>
                <div class="box-tools pull-right">
                    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-xs btn-default">Voltar</a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">

                    <table class="table table-striped table-bordered small">

                        <thead>
                            <tr>
                                <th style="width:15%">Data</th>
                                <th>Evento</th>
                                <th>Tabela</th>
                                <th>IP</th>
                                <th>User Agent</th>
                                <th style="width:20%">Antes</th>
                                <th style="width:20%">Depois</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($audits as $item)
                            <tr>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->event }}</td>
                                <td>{{ $item->auditable_type }}</td>
                                <td>{{ $item->ip_address }}</td>
                                <td>{{ $item->user_agent }}</td>
                                <td>
                                    @foreach($item->old_values as $key => $new)
                                        <li><strong>{{ $key }}</strong> - {{ $new }}</li>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($item->new_values as $key => $new)
                                        <li><strong>{{ $key }}</strong> - {{ $new }}</li>
                                    @endforeach
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    </div>
                </div>

                <!-- /.row -->
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
