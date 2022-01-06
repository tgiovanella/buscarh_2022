@extends('admin.layouts.app')

@section('title',__('Configuração de Anúncios'))



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
                        @include('admin.ads-config.form')
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- ./box-body -->
            <div class="box-footer">
                <div class="row">

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
