@extends('user.layouts.page')

@section('content')
<div class="row">
    <div class="col-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h2>Denunciar Anúncio</h2>

        @includeIf('user.reports.form',['type'=>'ads'])


    </div>
    
</div>
@endsection

@push('styles')

@endpush
