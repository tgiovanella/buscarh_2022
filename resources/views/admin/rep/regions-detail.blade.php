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
                        Exportar <i class="fa fa-file-excel-o" aria-hidden="true"></i></a>
                    </div> --}}
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">


                <div class="row">
                    <div class="col-md-12">
                        
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Data de Acesso</th>
                                    <th>Empresa</th>
                                    <th>Região</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($clicks as $item)
                                <tr>
                                    <td>{{ convertDateTimeUS2BR($item->created_at) }}</td>
                                    <td>{{ $item->company_name }}</td>
                                    <td>{{ $item->letter_state }}</td>
                                   
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
