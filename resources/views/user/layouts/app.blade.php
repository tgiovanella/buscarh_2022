@extends('user.layouts.html')

@section('container')


<div class="container fundoBranco rounded">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" id="divLogo">
            <img src="{{ asset('img/logoGigante.png') }}" class="img-fluid">
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12" id="divBanner">
            <div id="bannerFull">
                <banner-full></banner-full>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12 col-12 offset-lg-3 offset-md-3">
            @search_main()
            @endsearch_main
        </div>
    </div>
</div>

<div class="container mt-4 mb-2">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center">
            <h2 class="subTitulos">O melhor site de buscas de Prestadores de Serviço de RH</h2>
        </div>
    </div>
    <div class="d-lg-block d-md-block d-sm-none  d-none">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-12 ">
                <div class="card" style="width: 100%;">
                    <img src="https://i.picsum.photos/id/1/5616/3744.jpg?hmac=kKHwwU8s46oNettHKwJ24qOlIAsWN9d2TtsXDoCWWsQ" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">Ajudamos a encontrar de maneira organizada, rápida e efetiva prestadores de serviços de RH.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12 col-12 ">
                <div class="card" style="width: 100%;">
                    <img src="https://i.picsum.photos/id/201/5184/3456.jpg?hmac=3SX-1t9hHlAmc653Ox-EmJonZBCaCSK5b9FayvY4sbI" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">Aproximamos quem precisa de um determinado serviço, de qualquer subsistema de RH.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12 col-12 ">
                <div class="card" style="width: 100%;">
                    <img src="https://i.picsum.photos/id/180/2400/1600.jpg?hmac=Ig-CXcpNdmh51k3kXpNqNqcDYTwXCIaonYiBOnLXBb8" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">Geramos economia de tempo e mais efetividade nas buscas de serviços de RH.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="carouselExampleInterval" class="carousel slide d-lg-none d-md-none d-sm-block d-block" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" data-interval="10000">
                <div class="card" style="width: 100%;">
                <img src="https://i.picsum.photos/id/1/5616/3744.jpg?hmac=kKHwwU8s46oNettHKwJ24qOlIAsWN9d2TtsXDoCWWsQ" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text">Ajudamos a encontrar de maneira organizada, rápida e efetiva prestadores de serviços de RH.</p>
                </div>
            </div>
            </div>
            <div class="carousel-item" data-interval="2000">
                <div class="card" style="width: 100%;">
                <img src="https://i.picsum.photos/id/201/5184/3456.jpg?hmac=3SX-1t9hHlAmc653Ox-EmJonZBCaCSK5b9FayvY4sbI" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text">Aproximamos quem precisa de um determinado serviço, de qualquer subsistema de RH.</p>
                </div>
            </div>
            </div>
            <div class="carousel-item">
                <div class="card" style="width: 100%;">
                <img src="https://i.picsum.photos/id/180/2400/1600.jpg?hmac=Ig-CXcpNdmh51k3kXpNqNqcDYTwXCIaonYiBOnLXBb8" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text">Geramos economia de tempo e mais efetividade nas buscas de serviços de RH.</p>
                </div>
            </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
<div class="block-container">

    <div class="container">
        @include('user.layouts.message')
    </div>

    @yield('content')
</div>

@endsection
