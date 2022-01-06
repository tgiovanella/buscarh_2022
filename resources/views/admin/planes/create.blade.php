@extends('admin.layouts.app')

@section('title',__('Planos'))

@push('scripts')
<script type="text/javascript" src="{{ PagSeguro::getUrl()['javascript'] }}"></script>
<script>
    $(document).ready(function() {
        console.log(PagSeguroDirectPayment.setSessionId('{{ PagSeguro::startSession() }}')); //PagSeguroRecorrente tem um método identico,

        // $('#senderHash').val(PagSeguroDirectPayment.getSenderHash());

        // console.log(PagSeguroDirectPayment.getSenderHash())
    })
</script>
@endpush



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
                        <h1>{{ $plane->title }}</h1>
                        {{ PagSeguro::startSession() }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        @include('admin.planes.form')
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
