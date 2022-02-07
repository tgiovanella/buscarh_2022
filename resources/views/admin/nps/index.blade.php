@extends('admin.layouts.app')

@section('title','NPS')

@section('content')
<!-- Cards com os totais -->
<div class="row">
    <!-- Card com os totais -->
    <div class="col-lg-4 col-xs-6">
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{count($nps)}}</h3>
                <p>Total de Respostas</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
        </div>
    </div>
    <!-- Card com as respostas positivas -->
    <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{$npsPositivo}}</h3>
                <p>Respostas Positivas</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
        </div>
    </div>
    <!-- Card com as respostas Negativas -->
    <div class="col-lg-4 col-xs-6">
        <div class="small-box bg-red" title="">
            <div class="inner">
            <h3>{{$npsNegativo}}</h3>
                <p>Respostas Negativas</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
        </div>
    </div>
    
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <!--  -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Empresa</th>
                                    <th>Cotação</th>
                                    <th>Comentários</th>
                                    <th>Resposta</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($nps as $item)
                                    <tr>
                                        <td>{{ $item->company->name }}</td>
                                        <td>{{ $item->quote->title }}</td>
                                        <td>{{ $item->comment }}</td>
                                        <td>
                                            @if($item->answer)
                                                <span class="btn-sm btn-info">Sim</span>
                                            @else
                                                <span class="btn-sm btn-danger">Não</span>
                                            @endif
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
            </div>
            <!--  -->
            <div class="box-footer">
                <div class="row">
                    <div class="col-md-7 text-right paginate-count">{!! info_pages($nps) !!}</div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
