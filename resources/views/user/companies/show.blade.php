@extends('user.layouts.page')

@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        {{-- <div class="row">
                <div class="col-sm-10">
                    <h1>User name</h1>
                </div>
                <div class="col-sm-2"><a href="/users" class="pull-right"><img title="profile image"
                            class="img-circle img-responsive"
                            src="http://www.gravatar.com/avatar/28fd20ccec6865e2d5f0e1f4446eb7bf?s=100"></a></div>
            </div> --}}
        <div class="row">
            {{-- <div class="col-sm-3">
                <!--left col-->
                <div class="text-center">
                    <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail"
                        alt="avatar">

                </div>
                </hr><br>


                <div class="card mb-3">
                    <div class="card-header">Website <i class="fa fa-link fa-1x"></i></div>
                    <div class="card-body"><a href="{{ $company->site }}" target="_blank">{{ $company->site }}</a></div>
                </div>


                <ul class="list-group mb-3">
                    <li class="list-group-item list-group-item-action text-muted">Activity <i
                            class="fa fa-dashboard fa-1x"></i></li>
                    <li class="list-group-item list-group-item-action text-right"><span
                            class="pull-left"><strong>Shares</strong></span> 125</li>
                    <li class="list-group-item list-group-item-action text-right"><span
                            class="pull-left"><strong>Likes</strong></span> 13</li>
                    <li class="list-group-item list-group-item-action text-right"><span
                            class="pull-left"><strong>Posts</strong></span> 37</li>
                    <li class="list-group-item list-group-item-action text-right"><span
                            class="pull-left"><strong>Followers</strong></span> 78
                    </li>
                </ul>

                <div class="card card-default mb-3">
                    <div class="card-header">Social Media</div>
                    <div class="card-body">
                        <i class="fa fa-facebook fa-2x"></i> <i class="fa fa-github fa-2x"></i> <i
                            class="fa fa-twitter fa-2x"></i> <i class="fa fa-pinterest fa-2x"></i> <i
                            class="fa fa-google-plus fa-2x"></i>
                    </div>
                </div>

            </div> --}}
            <!--/col-3-->
            <div class="col-sm-12">
                <h2 class="mb-5">
                    {{ $company->name }}
                    
                    <div class="float-right">
                        
                        <div class="dropdown">
                            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                data-toggle="dropdown">
                                Opções
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item btn-sm" data-toggle="modal" data-target="#exampleModalCenter"
                                    href="#">Denunciar</a>
                            </div>
                        </div>

                    </div>
                </h2>


                <ul class="list-group">

                    <li class="list-group-item"><strong>Nome Fantasia: </strong>{{ $company->fantasy }}</li>
                    <li class="list-group-item"><strong>CPF/CNPJ: </strong>{{ $company->cpf_cnpj }}</li>
                    <li class="list-group-item"><strong>Site: </strong>{{ $company->site }}</li>
                    <li class="list-group-item"><strong>Telefone: </strong>{{ $company->phone }}</li>
                    <li class="list-group-item"><strong>CEP: </strong>{{ $company->cep }}</li>
                    <li class="list-group-item"><strong>Cidade: </strong>{{ @$company->city->title }}/{{ $company->uf }}
                    </li>
                    <li class="list-group-item"><strong>Endereço: </strong>{{ $company->address }},
                        {{ $company->number }}, {{ $company->complement }}. {{ $company->district }}.</li>
                    <li class="list-group-item"><strong>Responsável: </strong>{{ $company->responsible }}</li>
                    <li class="list-group-item"><strong>Email: </strong>{{ $company->email }}</li>
                    <li class="list-group-item"><strong>Categorias: </strong>
                        @foreach($company->subcategories as $subcategory)
                        <a
                            href="{{ route('user.company.search',['category' => $subcategory->category->slug, 'subcategory' => $subcategory->slug]) }}"><span
                                class="badge badge-secondary">{{ $subcategory->name }}</span></a>
                        @endforeach
                    </li>
                </ul>

                <div class="float-right mt-3">
                    <a href="{{ route('user.companyevaluation.create',$company->id) }}" id="" class="btn btn-primary" 
                        role="button">
                        <i class="fa fa-star" aria-hidden="true"></i> Avaliar
                    </a>
                </div>
            </div>
            <!--/tab-content-->

        </div>
        <!--/col-9-->
    </div>
</div>


<!--- ============================================================================ -->

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" data-keyboard="false" data-focus="false" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Denúncia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('user.reports.form',['type'=>'company'])
            </div>

        </div>
    </div>
</div>
@endsection


@push('scripts')
<script>
$(document).ready(function () {



});
</script>
@endpush
