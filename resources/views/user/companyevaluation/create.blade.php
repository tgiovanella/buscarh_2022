@extends('user.layouts.page')

@section('content')
<div class="row">
    <div class="col-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h2>Avaliação</h2>

        @include('user.companyevaluation.form')


    </div>
</div>
@endsection

@push('styles')

@endpush
