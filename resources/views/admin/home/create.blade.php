@extends('admin.layouts.app')

@section('title',__('messages.title_festivals'))

@section('content')
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">@yield('title','Dashboard')</h3>

            <div class="box-tools pull-right">

            </div>
        </div>
        <div class="box-body">
            @includeIf('admin.instruments.form')
        </div>
        <!-- /.box-body -->
        <div class="box-footer">

        </div>
        <!-- /.box-footer-->
    </div>
    <!-- /.box -->
@endsection
