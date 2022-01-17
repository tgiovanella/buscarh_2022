@extends('user.layouts.page')

@section('content')

<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">

    <nav aria-label="">
        <!-- {{ $companies->links() }} -->
    </nav>

    <h4 class="subTitulos">
        <i class="material-icons float-right">business_center</i>
        Oportunidades Prestação Serviços
    </h4>

    <ul class="list-group list-group-flush" id="ulEmpresas">
        @forelse($quotes as $quote)
        <li class="list-group-item">
            <ul class="listaEmpresa">
                <li>
                    <h3>
                        <i class="material-icons">location_city</i>{{ $quote->company->name }}
                    </h3>
                </li>
                <li>
                    <h5>
                        <i class="material-icons">info</i>{{ $quote->title }}
                    </h5>
                    @foreach($quote->subcategories as $category)
                    <span class="label label-default">{{ $category->category->name }}:{{ $category->name }}</span>
                    @endforeach
                </li>

                <li><i class="material-icons">location_on</i> {{ $quote->company->address }}, {{ $quote->company->number }}
                    {{ $quote->complement }}.
                    {{ $quote->district }}. {{ @$quote->company->city->title }} - {{ $quote->company->uf }}
                </li>
                <li><i class="material-icons">phone</i> {{ $quote->company->phone }}</li>
                <li>
                    <a href="#" class="btn btn-more btn-primary">
                        Demonstrar Interesse
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </a>
                </li>
            </ul>
        </li>

        @empty
        <li class="list-group-item">
            @alert(['type' => 'warning'])
            Não existem Oportunidades.
            @endalert
        </li>
        @endforelse
    </ul>

    {{-- <nav aria-label="">
        {{ $companies->appends(Request::query())->links() }}
    </nav> --}}
</div>
<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
    <div class="sticky-top">
        <div class="subTitulos">
            <i class="material-icons float-right">bookmarks</i>
            Destaques
        </div>

        <banner-slide-sidebar category-id="{{ $categories_sidebar->id ?? null }}"></banner-slide-sidebar>
    </div>
</div>
</div>
@endsection

@push('styles')
<link href="{{ asset('user/css/segundo.css') }}" rel="stylesheet" type="text/css">
@endpush