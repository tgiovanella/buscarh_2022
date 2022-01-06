@extends('user.layouts.page')

@if($method == 'create')
@php($action = route('admin.ads.store'))
@php($method_field = method_field('POST'))
@else
@php($action = route('admin.ads.update',$ad))
@php($method_field = method_field('PUT'))
@endif


@section('content')
<advertise-create></advertise-create>
@endsection
