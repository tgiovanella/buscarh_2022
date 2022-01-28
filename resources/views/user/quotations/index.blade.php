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
                        Prestar serviço na Empresa: {{$candidate->where('id',$quote->company_id)->first()->fantasy}}
                    </h5>

                    <blockquote class="blockquote">
                        <p class="mb-0"><i class="material-icons mr-2">info</i> Atuar com</p>

                        <footer class="blockquote-footer">
                            <span class="label">{{$quote->quote->title }}</span>
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
                    @if(in_array($quote->company_id,$interested))

                    <a href="#" onclick="openCommets(event)" data-toggle="tooltip" data-placement="top" title="Ver ou iteragir com tomador de serviços" class="btn btn-more btn-success">
                        <i class="fa fa-comment" aria-hidden="true"></i> Negociação
                    </a>
                    @else
                    <!-- Link do formulario aqui, quando navegar pro formulario marca a notificacao como lida-->
                    <a href="#" data-src="{{$quote}}" onclick="openModalProposal(event)" class="btn btn-more btn-primary">

                        <i class="fa fa-plus" aria-hidden="true"></i> Detalhes
                    </a>
                    @endif

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
            <form role="form" class="form" action="/users/proposal" id="" method="post" enctype="multipart/form-data">
                <input id="company_id" type="hidden" name="company_id" value="">
                <input id="quote_id" type="hidden" name="quote_id" value="">
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
<div class="modal fade modal-right" id="comment-modal" tabindex="-1" aria-labelledby="quotLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-body">
                <div class="col-md-12">

                </div>
            </div>
            <div class="modal-footer modal-footer-fixed">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" title="Cancelar"><i class="glyphicon glyphicon-repeat"></i>Cancelar</button>
                <button class="btn btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i>
                    Salvar</button>
            </div>

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
    function openModalProposal(event) {
        //seleciona a proposta
        const data = $(event.target).data('src');
        //console.log(data)//JSON object
        $('#company_id').val(data.company_id);
        $('#quote_id').val(data.quote_id);
        $('#proposal-form-create').modal();
    }

    function openCommets(event) {

        $('#comment-modal').modal();
    }
</script>