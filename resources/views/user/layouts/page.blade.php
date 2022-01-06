@extends('user.layouts.html')

@section('container')
<div class="container fundoBranco rounded">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" id="divLogo">
            <a href="{{ url('/') }}"><img src="{{ asset('img/logoGigante.png') }}" class="img-fluid"></a>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12" id="divBanner">
            <div id="bannerFull">
                <banner-full category-id="@if(isset($categories_sidebar->id)) {{ $categories_sidebar->id }} @endif"></banner-full>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12 col-12 offset-lg-3 offset-md-3">
            @search_main()
            @endsearch_main
        </div>
    </div>



    <main id="content-main">


        @include('user.layouts.message')

        @yield('content')
    </main>
</div>
@endsection
