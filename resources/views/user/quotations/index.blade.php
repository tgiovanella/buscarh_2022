@extends('user.layouts.page')

@section('content')

<div class="col-sm-12">

    <nav aria-label="">

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
                        <i class="material-icons mr-2">location_city</i>{{ $quote->quote->company->fantasy }}
                    </h3>
                </li>
                <li>
                    <h5>
                        {{$quote->quote->title }}
                    </h5>

                    <blockquote class="blockquote">
                        <p class="mb-0"><i class="material-icons mr-2">info</i> Atuar com</p>
                        <footer class="blockquote-footer">
                            @foreach($quote->quote->subcategories as $category)
                            <span class="label label-default">{{ $category->category->name }}:{{ $category->name }}</span>
                            @endforeach
                        </footer>
                    </blockquote>

                </li>

                <li><i class="material-icons mr-2">location_on</i> {{$quote->quote->company->address }}, {{$quote->quote->company->number }}
                    {{$quote->quote->complement }}.
                    {{$quote->quote->district }}. {{$quote->quote->company->city->title }} - {{$quote->quote->company->uf }}
                </li>
                <li><i class="material-icons mr-2">phone</i> {{$quote->quote->company->phone }}</li>
                <li>
                    <!-- Link do formulario aqui, quando navegar pro formulario marca a notificacao como lida-->
                    <a href="#" onclick="openModalProposal()" class="btn btn-more btn-primary">

                        <i class="fa fa-plus" aria-hidden="true"></i> Detalhes
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
</div>
<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>

<!-- MODAL DE PROPOSTA PARA A COTAÇÃO -->
<div class="modal fade" id="proposal-form-create" tabindex="-1" aria-labelledby="quotLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form role="form" class="form" action="/users/proposal" id="" method="post"  enctype="multipart/form-data">
                <input type="hidden" name="company_id" value="<?= $quotes[0]->company_id ?>">
                <input type="hidden" name="quote_id" value="<?= $quotes[0]->quote_id ?>">
                @csrf
                <div class="modal-body">
                    <div class="col-md-12">
                        @include('user.proposal.create')
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" title="Cancelar"><i class="glyphicon glyphicon-repeat"></i>Cancelar</button>
                    <button class="btn btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i>
                        Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('styles')
<link href="{{ asset('user/css/segundo.css') }}" rel="stylesheet" type="text/css">
@endpush

<script>
    /**
     * Método que abre o modal do formulário de proposta.
     */
    function openModalProposal() {
        $('#proposal-form-create').modal();
    }
</script>