@extends('admin.layouts.app')

@section('title',__('Relatório de Cliques por Região'))



@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">@yield('title')</h3>
                <div class="box-tools pull-right">
                    
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
                                    <th>Região</th>
                                    <th class="text-right">Total de Cliques</th>
                                    <th class="text-right"></th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($clicks as $item)
                                <tr>
                                    <td>{{ $item->letter_state }}</td>
                                    <td class="text-right">{{ $item->count }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('admin.clicks-regions.show',$item->letter_state) }}" class="btn btn-xs btn-default bg-gray" alt="Detalhes"><i
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
