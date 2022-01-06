@extends('admin.layouts.app')

@section('title',__('Denuncia'))



@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">@yield('title')</h3>
                <div class="box-tools pull-right">

                    @history(['auditable_id' => $report->id, 'auditable_type' => 'App\Report'])
                    {{-- Botão History  --}}
                    @endhistory

                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>Nome do Denunciante: </strong>{{ $report->name }}
                                </li>
                                <li class="list-group-item"><strong>CPF/CNPJ do Denunciante:
                                    </strong>{{ $report->cpf_cnpj }}</li>
                                <li class="list-group-item"><strong>Email do Denunciante: </strong>{{ $report->email }}
                                </li>
                                <hr>
                                <li class="list-group-item"><strong>Empresa Denunciada:
                                    </strong>{{ @$report->company->name }}</li>
                                <li class="list-group-item"><strong>CNPJ da Denunciada:
                                    </strong>{{ @$report->company->cpf_cnpj }}</li>
                                <li class="list-group-item"><strong>Cidade/UF:
                                    </strong>{{ @$report->company->city->title }}/{{ @$report->company->city->state->letter }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- /.row -->
            </div>
            <!-- ./box-body -->
            <div class="box-footer">
                <!-- /.row -->
            </div>
            <!-- /.box-footer -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>



@endsection
