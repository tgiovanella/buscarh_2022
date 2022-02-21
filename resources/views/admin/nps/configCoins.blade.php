@extends('admin.layouts.app')

@section('title','Configuração das WebMoedas')

@section('content')
<!-- Cards com os totais -->
<div class="row">
    <!-- Card com os totais -->
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{$configCoins->amount_coins}}</h3>
                <p>Pacote de WebMoedas</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <span class="small-box-footer"> Valor do Pacote: <strong>R$ {{number_format($configCoins->price_coins , 2, ',', '.')}}</strong></span>
        </div>
    </div>    
</div>
<hr>
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Alterações do Pacote</h3>
    </div>
    <div class="box-body">
        <form role="form" class="form" id="" method="post">
            <!-- Recarga de moedas -->
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="coins">Valor do Pacote</label>
                    <input type="number" name="" id="price-coins" class="form-control" value="{{$configCoins->price_coins}}">
                </div>
                <div class="form-group col-md-4">
                    <label for="coins">Moedas por Pacote</label>
                    <input type="number" name="" id="price-quote" class="form-control" value="{{$configCoins->price_quote}}">
                </div>
                <div class="form-group col-md-4">
                    <label for="coins">Moedar por Cotação</label>
                    <input type="number" name="" id="amount-coins" class="form-control" value="{{$configCoins->amount_coins}}">
                </div>
            </div>
            <div class="row float-left">
                <div class="col-md-10"></div>
                <div class="col-md-1">
                    <button type="button" onclick="saveConfigCoins(event)" class="btn btn-success"><i class="fa fa-save"></i> Salvar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<hr>
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Solicitações de compra de Moedas</h3>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Empresa</th>
                            <th>Pacotes</th>
                            <th>Total Moedas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($candidateBuyCoins as $candidateBuyCoin)
                            <tr>
                                <td>{{$candidateBuyCoin->company->name}}</td>
                                <td>{{$candidateBuyCoin->amount_coins}}</td>
                                <td>{{$candidateBuyCoin->total_coins}}</td>
                            </tr>
                        @empty
                        <tr class="list-group-item">
                            <td colspan="3">
                            @alert(['type' => 'warning'])
                                Sem informações a serem exibidas.
                            @endalert
                            </td>
                        </tr>
                @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script>
        const csrf = "{{csrf_token()}}";
        const state = {};

        /**
         * Salva a configuração de compra de moedas.
         */
        const saveConfigCoins = (event) => {
            event.target.disabled = true

            const form = new FormData();

            form.append('price_coins', $('#price-coins').val());
            form.append('price_quote', $('#price-quote').val() );
            form.append('amount_coins', $('#amount-coins').val() );
            form.append('_token', csrf);

            requestPost('/users/config-buy-coins', form).then(resp => {
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