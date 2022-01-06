@extends('admin.layouts.app')

@section('title',__('Gestão de Denúncias'))


@push('scripts')
<script>
    function esconderLinha(idDaLinha) {
        // procura o elemento com o ID passado para a função e coloca o estado para o contrario do estado actual
        $("#" + idDaLinha).toggle();
    }


    $(document).ready(function () {



        $('.btn-block-company').click(function(event){


            let id = $(this).data('id');
            let cpf_cnpj = $(this).data('cpf_cnpj');
            let name = $(this).data('name');
            let _token = $('meta[name="csrf-token"]').attr('content');



            console.log(id);

            $.alert({
                title: 'Alerta',
                icon: 'fa fa-exclamation-circle',
                columnClass: 'large',
                type: 'red',
                content: 'Deseja realmente bloquear a empresa <strong>' + name + '</strong>, inscrita no CNPJ/CPF <strong>' + cpf_cnpj + '</strong>?',
                buttons : {
                    cancel: {
                        text: 'Cancelar', // With spaces and symbol
                        btnClass: 'btn-default'
                    },
                    evaluate: {
                        text: '<i class="fa fa-ban"></i> Bloquear',
                        btnClass: 'bg-red',
                        action: function () {
                            // window.location.href = '/admin/inscriptions/' + inscription_id + '/edit'

                            let data = {
                                _token : _token,
                                id : id
                            };

                            $.ajax({
                                type: "POST",
                                url: "/admin/reports/" + id + '/block',
                                data: data,
                                dataType: "json",
                                success: function (response) {
                                    console.log(response);

                                    if(response.status) {

                                        $.alert({
                                            title: 'Alerta',
                                            icon: 'fa fa-exclamation-circle',
                                            columnClass: 'large',
                                            type: 'green',
                                            content: response.message,
                                            buttons : {
                                                Ok: {
                                                    action: function () {
                                                        window.location.href = '/admin/reports/';
                                                    }
                                                }
                                            }
                                        });
                                        //

                                    } else {
                                        $.alert(response.message);

                                    }
                                }
                            });
                        }
                    }

                }
            });
        });


        //recusa a denuncia
        $('.btn-cancel-block-company').click(function(event){


            let id = $(this).data('id');
            let cpf_cnpj = $(this).data('cpf_cnpj');
            let name = $(this).data('name');
            let _token = $('meta[name="csrf-token"]').attr('content');



            console.log(id);

            $.alert({
                title: 'Alerta',
                icon: 'fa fa-exclamation-circle',
                columnClass: 'large',
                type: 'red',
                // content: 'Deseja realmente bloquear a empresa <strong>' + name + '</strong>, inscrita no CNPJ/CPF <strong>' + cpf_cnpj + '</strong>?',
                // content: 'Deseja realmente bloquear a empresa <strong>' + name + '</strong>, inscrita no CNPJ/CPF <strong>' + cpf_cnpj + '</strong>?',
                content: `Você está <strong>RECUSANDO</strong> a denúncia. Tem certeza que deseja ignorar as denúncias da empresa <strong>${name}</strong>, inscrita no CNPJ/CPF <strong>${cpf_cnpj}</strong>?`,
                buttons : {
                    cancel: {
                        text: 'Cancelar', // With spaces and symbol
                        btnClass: 'btn-default'
                    },
                    evaluate: {
                        text: '<i class="fa fa-trash"></i> Recusar Denúncia',
                        btnClass: 'bg-red',
                        action: function () {
                            // window.location.href = '/admin/inscriptions/' + inscription_id + '/edit'

                            let data = {
                                _token : _token,
                                id : id
                            };

                            $.ajax({
                                type: "POST",
                                url: "/admin/reports/" + id + '/ignore-block',
                                data: data,
                                dataType: "json",
                                success: function (response) {
                                    console.log(response);

                                    if(response.status) {

                                        $.alert({
                                            title: 'Alerta',
                                            icon: 'fa fa-exclamation-circle',
                                            columnClass: 'large',
                                            type: 'green',
                                            content: response.message,
                                            buttons : {
                                                Ok: {
                                                    action: function () {
                                                        window.location.href = '/admin/reports/';
                                                    }
                                                }
                                            }
                                        });
                                        //

                                    } else {
                                        $.alert(response.message);

                                    }
                                }
                            });
                        }
                    }

                }
            });
        });




    });
</script>
@endpush




@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">@yield('title')</h3>
                <div class="box-tools pull-right">

                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">


                <div class="row">
                    <div class="col-md-12">
                        <form class="form form-search" method="GET" action="">
                            <strong>Filtros</strong>
                            <div class="row">


                                <div class="form-group col-md-3">
                                    <label class="sr-only" for="name">Descrição</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name',request('name')) }}" placeholder="Descrição">
                                </div>

                                <div class="form-group col-md-3">
                                    <label class="sr-only" for="name">Status {{ \request('status') }}</label>
                                    <select name="status" class="form-control" id="status">
                                        <option value="{{ App\Report::STATUS_PENDING }}"
                                            @if(\request('status')==App\Report::STATUS_PENDING ||
                                            \request('status')==null) selected @endif>Pendente</option>
                                        <option value="{{ App\Report::STATUS_CONFIRMED }}"
                                            @if(\request('status')==App\Report::STATUS_CONFIRMED) selected @endif>
                                            Confirmado</option>
                                        <option value="{{ App\Report::STATUS_CANCELED }}"
                                            @if(\request('status')==App\Report::STATUS_CANCELED) selected @endif>
                                            Cancelado</option>
                                    </select>
                                </div>

                                <div class="col-md-6 text-right">
                                    <button type="submit" class="btn btn-success">Buscar</button>
                                    <a href="{{ route('admin.reports.index') }}" class="btn btn-warning">Limpar</a>
                                </div>

                            </div>


                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">




                        <table class="table table-bordered table-striped table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Empresa</th>
                                    <th>CPF/CNPJ</th>
                                    <th>Cidade/UF</th>
                                    <th>Dono (usuário)</th>
                                    <th class="text-center">Qtd. Denúncias</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($companies as $company)
                                <tr>
                                    <td class="text-center" style="width: 3%;">
                                        <button class="btn btn-xs btn-default"
                                            onClick="esconderLinha('row-{{$company->id}}')">
                                            +
                                        </button>
                                    </td>
                                    <td><a href="{{ route('admin.companies.show',$company) }}"
                                            target="_blank">{{ $company->name }}</a></td>
                                    <td>{{ $company->cpf_cnpj }}</td>
                                    <td>{{ @$company->city->title }}/{{ $company->uf }}</td>
                                    <td>{{ @$company->owner->name }}</td>



                                    <td class="text-center">
                                        <span
                                            class="label label-@if($company->reports->count() >= 3){{ 'danger' }}@else{{ 'warning' }}@endif">{{ $company->reports->count() }}</span>

                                    </td>

                                </tr>
                                <tr id="row-{{$company->id}}" style="display: none">
                                    <td></td>
                                    <td colspan="5">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th>Solicitante</th>
                                                    <th>CPF/CNPJ</th>
                                                    <th>Email</th>
                                                    <th class="text-center">Status</th>
                                                    <th class="text-center">Motivo</th>
                                                    <th class="text-center" style="width: 10%">Ação</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($company->reports as $item)
                                                <tr>
                                                    <td class="text-center">{{ $loop->index + 1 }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->cpf_cnpj }}</td>
                                                    <td>{{ $item->email }}</td>
                                                    <td class="text-center">
                                                        {!!
                                                        labels($item->status,'messages.status_report','myconfig.colors_status_reports')
                                                        !!}
                                                    </td>


                                                    <td class="text-center"><span
                                                            class="label label-default">{{ __('general.tag_report_companies.'.$item->tag) }}</span>
                                                    </td>


                                                    <td class="text-center">
                                                        @actions(['item'=>$item, 'route' => 'reports','btns' => 'show'])

                                                        @endactions()
                                                    </td>
                                                </tr>

                                                @empty
                                                <tr>
                                                    <td colspan="6">
                                                        {{ __('general.msg_not_register')}}
                                                    </td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="7" class="text-right">
                                                        <a href="#"
                                                            class="btn btn-xs btn-default btn-cancel-block-company"
                                                            data-id="{{ $company->id }}"
                                                            data-name="{{ $company->name }}"
                                                            data-cpf_cnpj="{{ $company->cpf_cnpj }}"><i
                                                                class="fa fa-trash" aria-hidden="true"></i> RECUSAR
                                                            DENÚNCIA</a>
                                                        <a href="#" class="btn btn-xs btn-danger btn-block-company"
                                                            data-id="{{ $company->id }}"
                                                            data-name="{{ $company->name }}"
                                                            data-cpf_cnpj="{{ $company->cpf_cnpj }}"><i
                                                                class="fa fa-ban" aria-hidden="true"></i> BLOQUEAR
                                                            EMPRESA</a>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </td>
                                </tr>

                                @empty
                                <tr>
                                    <td colspan="5">
                                        {{ __('general.msg_not_register')}}
                                    </td>
                                </tr>
                                @endforelse

                            </tbody>
                        </table>



                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- ./box-body -->
            <div class="box-footer">
                <div class="row">
                    <div class="col-md-4 text-left">{{ $companies->links() }}</div>
                    <div class="col-md-7 text-right paginate-count">{!! info_pages($companies) !!}</div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-footer -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>



@endsection
