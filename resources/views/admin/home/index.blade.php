@extends('admin.layouts.app')

@section('title',__('Dashboard'))

@section('content')
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua" title="Empresas cadastradas após {{ date('d/m/Y', strtotime("first day of this month")) }}." >
            <div class="inner">
                <h3>{{ $new_companies }}</h3>

                <p>Novas Empresas</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="{{ route('admin.companies.index') }}" class="small-box-footer">Mais informações <i
                    class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>0</h3>


                <p>Assinantes Ativos</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{ route('admin.orders.index') }}" class="small-box-footer">More info <i
                    class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>{{ $user_register }}</h3>

                <p>Usuários Registrados</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ route('admin.users.index') }}" class="small-box-footer">Mais informações <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red" title="Termos pesquisados após {{ date('d/m/Y', strtotime("first day of this month")) }}.">
            <div class="inner">
                <h3>{{ $terms_seach }}</h3>

                <p>Novos Termos Pesquisados</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ route('admin.analytics.terms') }}" class="small-box-footer">Mais Informações <i
                    class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Últimos termos buscados</h3>

                <div class="box-tools pull-right">
                    {{-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <div class="btn-group">
                        <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-wrench"></i></button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                        </ul>
                    </div>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                            class="fa fa-times"></i></button> --}}
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Data</th>
                            <th>Termo</th>
                            <th>Plataforma</th>
                            <th>Browser</th>
                            <th>Móbile</th>
                            <th>Device</th>
                            <th>IP</th>
                            <th>Usuário</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($search_analytics as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->term }}</td>
                            <td>{{ $item->platform }}</td>
                            <td>{{ $item->browser }}</td>
                            <td>{{ !$item->is_desktop ? 'SIM' : 'NÃO' }}</td>
                            <td>{{ $item->device }}</td>
                            <td>{{ $item->remote_addr }}</td>
                            <td>{{ $item->user_id }}</td>
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

<div class="row">
    <div class="col-md-7">
        <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
                <li class="active"><a href="#revenue-chart" data-toggle="tab">Pendentes</a></li>
                <li><a href="#sales-chart" data-toggle="tab">Concluídas</a></li>
                <li class="pull-left header"><i class="fa fa-inbox"></i> Últimos anúncios</li>
            </ul>
            <div class="tab-content no-padding">
                <!-- Morris chart - Sales -->
                <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
                <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <!-- Info Boxes Style 2 -->
        <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Total de Empresas</span>
                <span class="info-box-number">{{ $total_companies }}</span>

                <div class="progress">
                    <div class="progress-bar" style="width: 50%"></div>
                </div>
                <span class="progress-description">
                    {{-- 50% Increase in 30 Days --}}
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
        <div class="info-box bg-green">
            <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>
{{-- TODO: AQUI --}}
            <div class="info-box-content">
                <span class="info-box-text">Total de Anúncios</span>
                <span class="info-box-number">{{ $total_adverts }}</span>

                <div class="progress">
                    <div class="progress-bar" style="width: 20%"></div>
                </div>
                <span class="progress-description">
                    {{-- 20% Increase in 30 Days --}}
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
        <div class="info-box bg-red" style="display: none">
            <span class="info-box-icon"><i class="ion ion-ios-cloud-download-outline"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Downloads</span>
                <span class="info-box-number">114,381</span>

                <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                    70% Increase in 30 Days
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
        <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="ion-ios-chatbubble-outline"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Total de Contatos</span>
                <span class="info-box-number">{{ $total_contact }}</span>

                <div class="progress">
                    <div class="progress-bar" style="width: 40%"></div>
                </div>
                <span class="progress-description">
                    {{-- 40% Increase in 30 Days --}}
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
</div>
@endsection
