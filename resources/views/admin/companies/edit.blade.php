@extends('admin.layouts.app')

@section('title',__('Empresas'))

@push('scripts')
<script>
    $(document).ready(function () {

        })
</script>
@endpush

@section('content')
<!-- Default box -->
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">@yield('title','Dashboard')</h3>

        <div class="box-tools pull-right">
            @history(['auditable_id' => $company->id, 'auditable_type' => 'App\Company'])
            {{-- Botão History  --}}
            @endhistory
        </div>
    </div>
    <div class="box-body">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#dados" data-toggle="tab">
                        <h4>Dados da Empresa</h4>
                    </a></li>

                <li><a href="#destaque" data-toggle="tab">
                        <h4>Destaque</h4>
                    </a></li>
                <li><a href="#assinatura" data-toggle="tab">
                        <h4>Assinatura</h4>
                    </a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="dados">
                    @includeIf('admin.companies.form',['company' => $company])
                </div>
                <div class="tab-pane" id="destaque">
                    @include('admin.companies.highlighted')
                </div>
                <div class="tab-pane" id="assinatura">
                    @include('admin.companies.orderpayment')
                </div>
            </div>

        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
    </div>
    <!-- /.box-footer-->
</div>
<!-- /.box -->
@endsection
