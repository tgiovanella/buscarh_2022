@extends('admin.layouts.app')

@section('title',__('Assinaturas'))



@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">@yield('title')</h3>
                <div class="box-tools pull-right">
                    {{-- <a href="{{ route('admin.planes.create') }}" class="btn btn-sm btn-primary"><i
                        class="fa fa-plus-circle" aria-hidden="true"></i> Cadastrar</a> --}}
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
                                    <a href="{{ route('admin.planes.index') }}" class="btn btn-warning">Limpar</a>
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
                                    <th>Cliente/Usuário</th>
                                    <th>Produto</th>
                                    <th>Valor</th>
                                    <th>Plano</th>
                                    <th>Adesão</th>
                                    <th>Teste</th>
                                    <th>Cancelamento</th>
                                    <th class="text-center">Anúncio</th>


                                    {{-- <th class="text-center" style="width: 10%">Ação</th> --}}
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($orders as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ @$item->ads->user->name }}</td>
                                    <td>{{ @$item->plane->name }}</td>
                                    <td>{{ number_format(@$item->plane->amount_per_payment,2,',','.') }} R$</td>

                                    <td>{{ __('general.planes.'. @$item->plane->period) }}</td>
                                    <td>{{ convertDate($item->subscribed_at) }}</td>
                                    <td>{{ convertDate($item->trial_expired_at) }}</td>
                                    <td class="text-center"></td>
                                    <td class="text-center">@if(isset($item->ads->status))
                                        {!! labels_status_ads(@$item->ads->status) !!}
                                        @endif</td>




                                    <td class="text-center">
                                        {{-- @actions(['item'=>$item, 'route' => 'planes','btns' => 'edit|delete'])--}}
                                        {{-- botão de ação --}}
                                        {{-- @endactions()  --}}
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
                    <div class="col-md-4 text-left">{{ $orders->links() }}</div>
                    <div class="col-md-7 text-right paginate-count">{!! info_pages($orders) !!}</div>
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
