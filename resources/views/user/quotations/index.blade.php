@extends('user.layouts.page')

@section('content')

<div class="col-sm-12">
    <div id="flash-message" class="alert alert-dismissible my-2 fade show" role="alert">
        <span></span>
        <button onclick="flashclose()" type="button" class="close" aria-label="Close">
            <i aria-hidden="true">&times;</i>
        </button>
    </div>
    <nav aria-label="">

    </nav>
    @if($candidate)
        <ul class="nav nav-tabs" id="tabUser" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="proposal-tab" data-toggle="tab" href="#proposal" role="tab" aria-controls="proposal" aria-selected="true">Oportunidades Prestação Serviços</a>
            </li>
        </ul>
        <div class="tab-content">
            <!-- Oportunidades de prestação de serviços -->
            <div class="tab-pane fade show active" id="proposal" role="tabpanel" aria-labelledby="proposal-tab">
                <ul class="list-group list-group-flush" id="ulEmpresas">
                    @forelse($quotes->filter(fn($q) => $q->quote->proposal_id === null) as $quote)
                        <li class="list-group-item">
                            <ul class="listaEmpresa">
                                <li>
                                    <h3>
                                        <i class="material-icons mr-2">location_city</i>Solicitante: <strong>{{ $quote->quote->company->fantasy }}</strong>
                                    </h3>
                                </li>
                                <li>
                                    <h5>
                                        Prestadora: <strong>{{$candidate->where('id',$quote->company_id)->first()->fantasy}}</strong>
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
                                <li>
                                    <!-- Valida se o usuário ja pagou pra ver essa cotação -->
                                    @if($quote->is_pay)
                                        @if(in_array($quote->quote_id,$interested))
                                            <a href="#" data-src="{{$quote}}" onclick="openCommets(event)" data-toggle="tooltip" data-placement="top" title="Ver ou iteragir com tomador de serviços" class="btn btn-more btn-success">
                                                <i class="fa fa-comment" aria-hidden="true"></i> Negociação
                                            </a>
                                        @else
                                            <!-- Link do formulario aqui, quando navegar pro formulario marca a notificacao como lida-->
                                            <a href="#" data-src="{{$quote}}" onclick="openModalProposal(event)" class="btn btn-more btn-primary">
                                                <i class="fa fa-plus" aria-hidden="true"></i> Detalhes
                                            </a>
                                        @endif
                                    @else
                                        <a href="#" data-src="{{$quote}}" onclick="openModalParticipate(event)" data-toggle="tooltip" data-placement="top" title="Participar da cotação" class="btn btn-more btn-secondary">
                                            <i class="fa fa-home" aria-hidden="true"></i> Participar
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
        </div>
    @else
        <h4>Empresas não cadastradas, por favor realize o cadastro das empresas para participar das cotações.</h4>
    @endif
</div>
<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
@if($candidate)
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
                            Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- MODAL DE COMENTÁRIOS -->
    <div class="modal fade modal-right" id="comment-modal" tabindex="-1" aria-labelledby="quotLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body comment">
                    
                </div>
                <div class="resposta p-3" style="margin-bottom:80px; display:none">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="infos" class="control-label font-weight-bold">
                                {{__('Novo Comentário')}}
                            </label>
                            <textarea class="form-control" name="comments" id="comments" cols="30" rows="5" required></textarea>

                        </div>
                    </div>
                </div>
                <div class="modal-footer modal-footer-fixed">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" title="Cancelar"><i class="glyphicon glyphicon-repeat"></i>Cancelar</button>
                    <button class="btn btn-success" onclick="sendComment(event)"><i class="glyphicon glyphicon-ok-sign"></i>
                        Enviar
                    </button>
                </div>

            </div>
        </div>
    </div>
    <!-- MODAL QUE MOSTRA O SALDO DE MOEDAS E CONFIRMA SE O USUÁRIO VAI PARTICIPAR DA COTAÇÃO -->
    @if(isset($quote))
        <div class="modal fade" id="quote-participate" tabindex="-1" aria-labelledby="quotLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <form role="form" class="form" id="" method="post">
                        <input type="hidden" id="recebeQuoteID">
                        <input type="hidden" id="recebeCompanyID">
                        @csrf
                        <div class="modal-header">
                            <h5>Para participar da cotação será cobrado <strong class="text-primary">${{$coins->price_quote}} WebMoedas</strong> </h5>
                        </div>
                        <div class="modal-body">
                            <!-- Se tiver saldo mostra a opção de ir para o formulário de proposta -->
                            @if($candidate[0]->balance_coins >= $coins->price_quote)
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>Seu saldo é de <strong>R$ {{number_format($candidate[0]->balance_coins, 2, ',', '.')}}</strong></h4>
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-danger" role="alert">
                                            <h6><strong>$ {{$candidate[0]->balance_coins}} WEbMoedas </strong>- Saldo Insuficiente para participar da cotação!</h6>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" title="Cancelar"><i class="glyphicon glyphicon-repeat"></i>Cancelar</button>
                            @if($candidate[0]->balance_coins >= $coins->price_quote)
                                <button class="btn btn-success" data-src="{{$quote}}" onclick="closeModalParticipate(), openModalProposal(event)" type="button"><i class="glyphicon glyphicon-ok-sign"></i>
                                Participar</button>
                            @else
                            <button class="btn btn-primary" data-src="{{$quote}}" onclick="openModalBuyCoins()" type="button"><i class="glyphicon glyphicon-ok-sign"></i>
                                Comprar WebCoins</button>
                            @endif
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
    <!-- MODAL COM FORMULÁRIO DE COMPRA DE MOEDAS -->
    <div class="modal fade" id="buy-coins" tabindex="-1" aria-labelledby="quotLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form role="form" class="form" id="" method="post">
                    <input type="hidden" id="coins-CompanyId">
                    @csrf
                    <div class="modal-header">
                        <h5><strong class="text-primary" >Comprar WebMoedas</strong></h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name">Valor do Pacote</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text">R$</div>
                                    </div>
                                    <input type="text" class="form-control" id="price-pack" title="Preço do Pacote de moedas" value="{{number_format($coins->price_quote, 2, ',', '.')}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="name">Moedas por Pacote</label>
                                <input type="number" class="form-control" id="coins-pack" name="" value="{{$coins->amount_coins}}" title="Quantidade de Moedas por Pacote" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="name">Quantidade</label>
                                <input type="number" onchange="calculateBuyCoins()" step="1" class="form-control" id="amount-coins" name="" title="Valor da proposta" required>
                            </div>
                            <div class="col-md-4">
                                <label for="name">Valor Total</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text">R$</div>
                                    </div>
                                    <input type="text" class="form-control" id="total-price" title="Preço total" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="name">Total Moedas</label>
                                <input type="number" class="form-control" id="total-coins" name="" title="Quantidade Total de Moedas" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" title="Cancelar"><i class="glyphicon glyphicon-repeat"></i>Cancelar</button>
                        <button class="btn btn-primary"type="button"  onclick="saveBuyCoins(event)"><i class="glyphicon glyphicon-ok-sign"></i>
                            Comprar WebCoins</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif

@endsection

@push('styles')
    <link href="{{ asset('user/css/segundo.css') }}" rel="stylesheet" type="text/css">
@endpush
@push('scripts')
    <script>
        /**
        * Método que abre o modal do formulário de proposta.
        */
        function openModalProposal(event) {

            $('#company_id').val($('#recebeCompanyID').val());
            $('#quote_id').val($('#recebeQuoteID').val());
            $('#proposal-form-create').modal();
        }
        /**
         * Método que abre o modal para participar da contação
         */
         function openModalParticipate() {
            const data = $(event.target).data('src');
            $('#recebeQuoteID').val(data.quote_id);
            $('#recebeCompanyID').val(data.company_id);
             $('#quote-participate').modal();
         }
         /**
          * Abre o modal de comprar moedas.
          */
         function openModalBuyCoins() {
            $('#quote-participate').modal('hide');
            $('#buy-coins').modal();
         }
         /**
          * Calcula os valor e quantidades referentes a compra de moedas
          */
         function calculateBuyCoins() {
            var pricePack   = parseFloat($('#price-pack').val());
            var coinsPack   = parseInt($('#coins-pack').val());  
            var amountCoins = parseInt($('#amount-coins').val());         

            $('#total-price').val(pricePack * amountCoins);
            $('#total-coins').val(coinsPack * amountCoins);
            
         }
         /**
          * Fecha modal de participação de da cotação 
          */
         function closeModalParticipate() {
             $('#quote-participate').modal('hide');
         }

        const csrf = "{{csrf_token()}}";
        const state = {};

        const sendComment = (event) => {

            event.target.disabled = true
            const comment = $('#comments').val();

            const form = new FormData();
            form.append('proposal_id', state.data.proposal_id);
            form.append('company_id', state.data.company_id);
            form.append('quote_id', state.data.quote_id);
            form.append('comment', comment);
            form.append('is_candidate',true);
            form.append('_token', csrf);

            requestPost('/users/comment-proposal', form).then(resp => {
                if (resp.type === 'success') {
                    sessionStorage.setItem('success', resp.message);
                    window.location.reload();
                    return null;
                }
                flasherror(resp.message);

            }).finally(() => {
                event.target.disabled = false;
                $('#comment-modal').modal('close');
            });
            event.preventDefault();
        }

        function rederComment(data, company) {

            let content = "";

            for (let index = 0; index < data.length; index++) {

                const element = data[index];
                const d = new Date(element.created_at).toLocaleDateString('pt-BR');

                if (element.user_id !== null)
                    content += `
                            <div class="alert alert-primary " role="alert">
                                <h5 class="alert-heading"><strong>${company}</strong> disse:</h5>
                                <p>${element.comment}</p>
                                <small class="badge badge-secondary">${d}</small>
                            </div>`;
                else
                    content += `
                        <div class="alert alert-dark  " role="alert">
                            <h5 class="alert-heading"><strong>Eu:</strong></h5>
                            <p>${element.comment}</p>
                            <small class="badge badge-secondary">${d}</small>
                        </div>`;
            }
            return content;
        }

        /**
         * Salva a compra de moedas.
         */
        const saveBuyCoins = (event) => {
            event.target.disabled = true

            const form = new FormData();
            form.append('company_id', $('#recebeCompanyID').val());
            form.append('quote_id', $('#recebeQuoteID').val());
            form.append('amount_coins', $('#amount-coins').val());
            form.append('total_price', $('#total-price').val() );
            form.append('total_coins', $('#total-coins').val() );
            form.append('_token', csrf);

            requestPost('/users/quotes-buy-coins', form).then(resp => {
                if (resp.type === 'success') {
                    $('#quote-participate').modal('hide');
                    sessionStorage.setItem('success', resp.message);
                    window.location.reload();
                    return null;
                }
                flasherror(resp.message);

            }).finally(() => {
                event.target.disabled = false;
                $('#quote-participate').modal('hide');
            });
            event.preventDefault();
        }

        async function openCommets(event) {
            const data = $(event.target).data('src');
            $('#comment-modal').modal('show');
            $('#comment-modal').find('.comment').html(`<div class="text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>`);
            await fetch(`/users/comment-proposal/${data.company_id}/${data.quote_id}`)
                .then(resp => resp.json())
                .then(json => {
                    if (json.type === 'success' && json.data.length > 0) {
                        $('.resposta').show();
                        state.data = json.data[0];
                        $('#comment-modal').find('.comment').html(rederComment(json.data, data.quote.company.fantasy))
                    } else {
                        $('#comment-modal').find('.comment').html('<h4>Não existem comentários<h4>');
                    }
                });

        }

        async function requestPost(url, form) {
            return await fetch(url, {
                'method': 'POST',
                'Content-Type': 'multipart/form-data',
                "headers": {
                    'X-CSRF-TOKEN': form.get('_token'),
                    'X-Requested-With': 'XMLHttpRequest',
                },
                'body': form
            }).then(async (resp) => await resp.json());
        };
        const flashsuccess = (msg) => {
            $('#flash-message')
                .show()
                .addClass('alert-success')
                .find('span')
                .html(`<strong>Sucesso!</strong>${msg}`)

            sessionStorage.removeItem('success');
        }
        const flasherror = (msg) => {
            $('#flash-message').show()
                .addClass('alert-danger')
                .find('span')
                .html(`<strong>Error!</strong>${msg}`);
            sessionStorage.removeItem('error');
        }
        const flashclose = () => $('#flash-message').hide();
        $(function() {
            $('#flash-message').hide()
            $('.card-body').css('height', window.innerHeight - (window.innerHeight * 0.45));
            if (sessionStorage.getItem('success')) {
                flashsuccess(sessionStorage.getItem('success'));
            }
            if (sessionStorage.getItem('error')) {
                flasherror(sessionStorage.getItem('error'));
            }
        })
    </script>
    
@endpush