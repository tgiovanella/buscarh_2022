@extends('admin.layouts.app')

@section('title',__('Empresas'))



@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">@yield('title')</h3>
                <div class="box-tools pull-right">

                   @history(['auditable_id' => $company->id, 'auditable_type' => 'App\Company'])
                    {{-- Botão History  --}}
                   @endhistory

                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>Nome: </strong>{{ $company->name }}</li>
                                <li class="list-group-item"><strong>Nome Fantasia: </strong>{{ $company->fantasy }}</li>
                                <li class="list-group-item"><strong>CPF/CNPJ: </strong>{{ $company->cpf_cnpj }}</li>
                                <li class="list-group-item"><strong>Site: </strong>{{ $company->site }}</li>
                                <li class="list-group-item"><strong>Telefone: </strong>{{ $company->phone }}</li>
                                <li class="list-group-item"><strong>CEP: </strong>{{ $company->cep }}</li>
                                <li class="list-group-item"><strong>Cidade/UF: </strong>{{ @$company->city->title }}/{{ @$company->city->state->letter }}</li>
                                <li class="list-group-item"><strong>UFs de Atuação: </strong>
                                    @foreach ($company->operation_ufs as $item)
                                    <span class="label label-default">{{ $item->title }} ({{ $item->letter }})</span>,
                                    @endforeach
                                </li>
                                <li class="list-group-item"><strong>Cidades de Atuação: </strong>
                                    @foreach ($company->operation_cities as $item)
                                    <span class="label label-default">{{ @$item->title }}/{{ @$item->state->letter }}</span>,
                                    @endforeach
                                </li>
                                <li class="list-group-item"><strong>Endereço: </strong>{{ $company->address }}, {{ $company->number }} - {{ $company->district }}, {{ $company->complement }}.</li>
                                <li class="list-group-item"><strong>Responsável: </strong>{{ $company->responsible }}</li>
                                <li class="list-group-item"><strong>Email: </strong>{{ $company->email }}</li>
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
