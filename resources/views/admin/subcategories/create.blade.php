@extends('admin.layouts.app')

@section('title',__('Subcategorias'))

@push('scripts')
    <script>
        $(document).ready(function () {

        })
    </script>
@endpush

@section('content')
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">@yield('title','Dashboard')</h3>

            <div class="box-tools pull-right"></div>
        </div>
        <div class="box-body">


            @includeIf('admin.subcategories.form')
        </div>
        <!-- /.box-body -->
        <div class="box-footer">

        </div>
        <!-- /.box-footer-->
    </div>
    <!-- /.box -->
@endsection
