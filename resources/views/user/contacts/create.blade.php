@extends('user.layouts.page')

@section('content')
<div class="row">
    <div class="col-12 col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <h2>Fale Conosco</h2>

        @include('user.contacts.form')


    </div>
    <div class="col-12 col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <div class="card">


            <div class="card-body">
                <h4 class="card-title">Contato</h4>
                <p class="card-text">Entre em contato com nossa equipe</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><i class="fa fa-envelope" aria-hidden="true"></i> <strong>Email:</strong> <a
                        href="mailto:{{ get_config('email') }}">{{ get_config('email') }}</a></li>
            </ul>
        </div>

    </div>
</div>
@endsection

@push('styles')

@endpush
