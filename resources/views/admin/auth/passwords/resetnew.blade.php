@extends('admin.layouts.app')

@section('title',__('Redefinir Senha'))


@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    {{-- <li><a href="#">Examples</a></li> --}}
    <li class="active">{{ __('messages.title_isncriptions') }}</li>
</ol>
@endsection

@push('scripts')
    
@endpush


@section('content')
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">@yield('title','Dashboard')</h3>
            <div class="box-tools pull-right">
                
            </div>
        </div>
        <div class="box-body">
                
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            
        </div>
        <!-- /.box-footer-->
    </div>
    <!-- /.box -->
@endsection

