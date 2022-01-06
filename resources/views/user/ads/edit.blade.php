@extends('user.layouts.page')

@if($method == 'create')
@php($action = route('admin.ads.store'))
@php($method_field = method_field('POST'))
@else
@php($action = route('admin.ads.update',$advert))
@php($method_field = method_field('PUT'))
@endif


@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class="row">
            <div class="col-sm-12">
                <h2 class="mb-5">
                    {{ $advert->title }}
                    <div class="float-right">

                        {!! labels_status_ads($advert->status) !!}

                        <div class="dropdown">
                            {{-- <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                data-toggle="dropdown">
                                Opções
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item btn-sm" data-toggle="modal" data-target="#exampleModalCenter"
                                    href="#">Denunciar</a>
                            </div> --}}
                        </div>

                    </div>

                </h2>

                <h3>Informações</h3>
                <ul class="list-group">
                    <li class="list-group-item"><strong>Descrição: </strong>{{ $advert->description }}</li>
                    <li class="list-group-item"><strong>Email de Pagamento: </strong>{{ $advert->email_payment }}</li>
                    <li class="list-group-item"><strong>Responsável de Pagamento:
                        </strong>{{ $advert->responsible_payment }}
                    </li>
                    <li class="list-group-item"><strong>Telefone do Responsável: </strong>{{ $advert->phone }}</li>
                </ul>

                <h3>Plano/Assinatura</h3>
                <ul class="list-group">
                    <li class="list-group-item"><strong>Tipo: </strong>{{ @$advert->configuration->title }}</li>
                    <li class="list-group-item"><strong>Posição: </strong><img
                            src="{{ asset(config('myconfig.img_type_ads.'.@$advert->configuration->type)) }}"
                            class="text-center" width="50px"></li>
                    <li class="list-group-item"><strong>Período:
                        </strong>{{ __('general.planes.'.@$advert->configuration->plane->period) }}</li>

                    <li class="list-group-item"><strong>Valor:
                        </strong>{{ @$advert->configuration->plane->amount_per_payment}}
                        R$
                    </li>
                    <li class="list-group-item"><strong>Data da Fatura:
                        </strong>{{ @convertDate(@$advert->order_payment->created_at) }}</li>
                    <li class="list-group-item"><strong>Data Final de Teste:
                        </strong>{{ @convertDate(@$advert->order_payment->trial_expired_at) }}</li>

                </ul>
            </div>
        </div>

        <div class="row my-3">
            <div class="col-12 text-right">
                <a class="btn btn-danger" href="{{ route('user.checkout.cancel',$advert) }}">CANCELAR PLANO</a>
            </div>
        </div>




    </div>
    @endsection


    @push('styles')
    <style>
        .label {
            display: inline;
            padding: .2em .6em .3em;
            font-size: 75%;
            font-weight: bold;
            line-height: 1;
            color: @label-color;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: .25em;
        }


        .label-default {
            background: #6c757d;
            color: #f8f9fa;
        }

        .label-primary {
            background: #007bff;
            color: #f8f9fa;

        }

        .label-success {
            background: #28a745;
            color: #f8f9fa;

        }

        .label-info {
            background: #17a2b8;
            color: #f8f9fa;

        }

        .label-warning {
            background: #ffc107;
        }

        .label-danger {
            background: #dc3545;
            color: #f8f9fa;

        }
    </style>

    @endpush
