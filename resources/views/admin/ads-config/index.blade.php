@extends('admin.layouts.app')

@section('title',__('Configuração de Anúncios'))



@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">@yield('title')</h3>
                <div class="box-tools pull-right">
                    <a href="{{ route('admin.ads-config.create') }}" class="btn btn-sm btn-primary"><i
                            class="fa fa-plus-circle" aria-hidden="true"></i> Cadastrar</a>
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

                                <div class="col-md-9 text-right">
                                    <button type="submit" class="btn btn-success">Buscar</button>
                                    <a href="{{ route('admin.ads-config.index') }}" class="btn btn-warning">Limpar</a>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Título</th>
                                    <th>Tipo</th>
                                    <th class="text-center">Posição</th>
                                    {{-- <th>Posição</th> --}}
                                    <th>Largura x Altura</th>
                                    <th class="text-right">Plano</th>
                                    <th class="text-center">Status</th>

                                    <th class="text-center" style="width: 10%">Ação</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($adsconfig as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ config('myconfig.type_ads.'.$item->type) }}</td>
                                    <td class="text-center">
                                        <img 
                                        src="{{ asset(config('myconfig.img_type_ads.'.$item->type)) }}" 
                                        class="text-center" width="30px"></td>
                                    {{-- <td>{{ config('myconfig.position_ads.'.$item->position) }}</td> --}}
                                    <td>{{ $item->width }} x {{ $item->height }}</td>
                                    <td class="text-right">

                                        @if($item->plane)
                                        {{ $item->plane->name }} -
                                        {{ $item->plane->amount_per_payment }} R$
                                        {{ __('general.planes.'. $item->plane->period) }}/
                                        {{ $item->plane->trial_period_duration }}d teste
                                        @endif
                                    </td>
                                    <td class="text-center">{!! status($item->status) !!}</td>
                                    <td class="text-center">
                                        @actions(['item'=>$item, 'route' => 'ads-config','btns' => 'edit|delete'])
                                        {{-- botão de ação --}}
                                        @endactions()
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
                    <div class="col-md-4 text-left">{{ $adsconfig->links() }}</div>
                    <div class="col-md-7 text-right paginate-count">{!! info_pages($adsconfig) !!}</div>
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
