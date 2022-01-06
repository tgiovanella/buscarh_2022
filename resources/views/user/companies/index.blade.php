@extends('user.layouts.page')

@section('content')
<div class="row divFiltros">
    <div class="col-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h4 class="subTitulos">
            <i class="material-icons float-right">location_on</i>
            Filtros por UF</h4>
        <div class="btn-toolbar  justify-content-center">
            <div class="btn-group btn-group-sm flex-wrap" role="group">
                @foreach($ufs as $uf)
                <a class="btn rounded-0 btn-secondary @if(Request::has('uf') && Request('uf') == $uf->letter) active @endif "
                    href="{{ route('user.company.search',['category '=> Request::segment(2),'subcategory' => Request::segment(3)]) }}?uf={{ $uf->letter }}@if(Request::has('q'))&q={{ Request::input('q') }}@endif">{{ $uf->letter }}</a>

                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        {{-- <form class="card card-sm" method="GET">
            <h4 class="subTitulos">
                <i class="material-icons float-right">search</i>
                Pesquisar</h4>
            <div class="input-group mb-3">
                @if(\Request::input('uf'))
                <input type="hidden" name="uf" value="{{ \Request::input('uf') }}">
        @endif
        <input class="form-control form-control-lg" type="search" placeholder="palavra-chave" name="q"
            value="{{ Request::input('q') }}">
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit"><i class="material-icons">search</i></button>
        </div>
    </div>
    </form> --}}

    <div class="sticky-top">
        <h4 class="subTitulos">
            <i class="material-icons float-right">ballot</i>
            Especialidades</h4>

        @if($categories_sidebar)
        <a href="{{ route('user.company.search',['category '=> $categories_sidebar->slug]) }}"
            class="btn btn-secondary d-block rounded-0">
            {{ $categories_sidebar->name }}
            <i class="material-icons float-right">keyboard_arrow_down</i></a>
        <div class="show" id="clOutplacement">
            <div class="list-group">
                @foreach( $categories_sidebar->subcategories as $subcategory)
                <a href="{{ route('user.company.search',['category '=> $categories_sidebar->slug,'subcategory' => @$subcategory->slug ]) }}?uf={{ \Request::input('uf') }}"
                    class="list-group-item list-group-item-action rounded-0 @if($subcategory->slug == Request::segment(3)) active @endif">{{ $subcategory->name }}</a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">

    <nav aria-label="">
        <!-- {{ $companies->links() }} -->
    </nav>

    <h4 class="subTitulos">
        <i class="material-icons float-right">business_center</i>
        Empresas encontradas</h4>

    <ul class="list-group list-group-flush" id="ulEmpresas">
        @forelse($companies as $company)
        <li class="list-group-item">
            <ul class="listaEmpresa">
                <li>
                    <h3 style="">
                        <i class="material-icons">location_city</i>{{ $company->name }}
                        @if($company->highlighted)
                        <i class="material-icons float-right text-b-green" data-toggle="tooltip" data-placement="top"
                            title="Empresa Destacada">
                            stars
                        </i>
                        @endif

                    </h3>
                </li>
                <li><i class="material-icons">location_on</i> {{ $company->address }}, {{ $company->number }}
                    {{ $company->complement }}.
                    {{ $company->district }}. {{ @$company->city->title }} - {{ $company->uf }}</li>
                <li><i class="material-icons">phone</i> {{ $company->phone }}</li>
                <li>
                    <a href="{{ $company->site }}" target="_blank">
                        <i class="material-icons">computer</i> {{ Str::limit($company->site, 50, ' (...)') }}
                    </a>

                    <a href="{{ get_route_detail_company($company) }}" class="btn btn-more btn-primary">
                        Mais detalhes
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </a>
                </li>


            </ul>
        </li>


        @empty
        <li class="list-group-item">
            @alert(['type' => 'warning'])
            Não existem empresas cadastradas para a categoria.
            @endalert
        </li>
        @endforelse
    </ul>



    {{-- {{ dd(Request::query() )}} --}}

    <nav aria-label="">
        {{ $companies->appends(Request::query())->links() }}
    </nav>
</div>
<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
    <div class="sticky-top">
        <div class="subTitulos">
            <i class="material-icons float-right">bookmarks</i>
            Destaques
        </div>

        <banner-slide-sidebar category-id="{{ @$categories_sidebar->id }}"></banner-slide-sidebar>
    </div>
</div>
</div>
@endsection

@push('styles')
<link href="{{ asset('user/css/segundo.css') }}" rel="stylesheet" type="text/css">
@endpush
