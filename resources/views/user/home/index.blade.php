@extends('user.layouts.app')

@section('content')
<div id="parallax" class="parallax-window mb-0" data-parallax="scroll" data-image-src="img/bg6.jpg">
    <div class="container">
        <div class="row">
            @foreach($categories as $category)
            <div class="col-lg-3 col-md-4 col-sm-6 col-6 banner-category">
                <a href="{{ route('user.company.search',['category'=>$category->slug]) }}">
                    <img src="img/categorias/{{$category->id}}.png" class="img-fluid rounded">
                    <h2 class="title">{{ $category->name }}</h2>
                </a>
            </div>
            @endforeach
        </div>

    </div>
</div>

<div class="container mt-0 pt-4 pb-4" >
    <div class="row" >
        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
            <img src="img/woman-seach.png" alt="" class="img-fluid d-lg-block d-sm-block d-none">
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 col-12">
            <h4 class="subTitulos">Encontre os melhores profissionais de RH</h4>
            <p class="pl-2">Somos uma empresa que ajuda as pessoas e áreas de RH a encontrarem, de maneira organizada, rápida e efetiva, as consultorias e prestadores de serviço de RH ideais para suprirem a necessidade que tiverem.</p>
            <p class="pl-2">Nossa tecnologia e nossa paixão por ajudar os outros aproximam quem precisa de um determinado serviço, de qualquer subsistema de RH, e alavancam exponencialmente a visibilidade, crescimento e abrangência de atuação das consultorias de RH em todo Brasil.</p>
        </div>
    </div>
</div>


<div class="container fundoBranco rounded">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <h4 class="subTitulos">
                <i class="material-icons float-right">star</i>
                Empresas em destaque</h4>

            <banner-slide-logo></banner-slide-logo>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <h4 class="subTitulos">
                <i class="material-icons float-right">bookmarks</i>
                Parceiros</h4>
            <div id="gridRow">
                <div id="gridColumn">
                    <banner-slide-cloud></banner-slide-cloud>
                </div>
            </div>
        </div>
    </div>
</div>

@if(false)
<div class="pricing8 py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 text-center">
        <h3 class="mb-3">Confira nossos planos</h3>
        <!-- <h6 class="subtitle font-weight-normal">We offer 100% satisafaction and Money back Guarantee</h6> -->
      </div>
    </div>
    <!-- row  -->
    <div class="row mt-4">
      <!-- column  -->
      <div class="col-md-4 ml-auto pricing-box align-self-center">
        <div class="card mb-4">
          <div class="card-body p-4 text-center">
            <h5 class="font-weight-normal">Plano Básico</h5>
            <p class="mt-4">A licença do Plano Básico permite que você personalize, armazene e até hospede seu site usando sua plataforma</p>
          </div>
          <a class="btn btn-primary p-3 btn-block border-0 text-white" href="mailto:contato@buscarhweb.com.br">ENTRE EM CONTATO</a>
        </div>
      </div>
      <!-- column  -->

      <!-- column  -->
      <div class="col-md-4 ml-auto pricing-box align-self-center">
        <div class="card mb-4">
          <div class="card-body p-4 text-center">
            <h5 class="font-weight-normal">Plano Premium</h5>
            <p class="mt-4">A licença do Plano Premium permite que você personalize, armazene e até hospede seu site usando sua plataforma</p>
          </div>
          <a class="btn btn-success p-3 btn-block border-0 text-white" href="mailto:contato@buscarhweb.com.br">ENTRE EM CONTATO</a>
        </div>
      </div>
      <!-- column  -->

      <!-- column  -->
      <div class="col-md-4 ml-auto pricing-box align-self-center">
        <div class="card mb-4">
          <div class="card-body p-4 text-center">
            <h5 class="font-weight-normal">Plano Influence</h5>
            <p class="mt-4">A licença do Plano Influence permite que você personalize, armazene e até hospede seu site usando sua plataforma</p>
          </div>
          <a class="btn btn-danger p-3 btn-block border-0 text-white" href="mailto:contato@buscarhweb.com.br">ENTRE EM CONTATO</a>
        </div>
      </div>
      <!-- column  -->
    </div>
  </div>
</div>
@endif

@endsection


@push('scripts')

@endpush
