@extends('admin.layouts.app')

@section('title',__('Configurações'))



@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">@yield('title')</h3>
                <div class="box-tools pull-right">
                    <a href="{{ route('admin.configurations.create') }}" class="btn btn-sm btn-primary"><i
                            class="fa fa-plus-circle" aria-hidden="true"></i> Cadastrar</a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">


                <div class="row">
                    <div class="col-12">


                        <div class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-warning"></i> Alerta!</h4>
                            As configurações desta página só devem ser alteradas o campo Valor e Descrição. A mesma é
                            utilizado em constantes programáveis ao logo do site.<br/><strong>Só alterar o campo
                                Nome se realmente necessário.</strong>
                        </div>


                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <form class="form form-search" method="GET" action="">
                            <strong>Filtros</strong>
                            <div class="row">


                                <div class="form-group col-md-3">
                                    <label class="sr-only" for="question">Descrição</label>
                                    <input type="text" class="form-control" id="question" name="question"
                                        value="{{ old('question',request('question')) }}" placeholder="Pergunta">
                                </div>

                                <div class="col-md-9 text-right">
                                    <button type="submit" class="btn btn-success">Buscar</button>
                                    <a href="{{ route('admin.pages.index') }}" class="btn btn-warning">Limpar</a>
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
                                    <th>Nome</th>
                                    <th>Valor</th>
                                    <th>Descrição</th>
                                    <th class="text-center">Tipo</th>

                                    <th class="text-center" style="width: 10%">Ação</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($configurations as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->value }}</td>
                                    <td>{{ $item->descriptions }}</td>
                                    <td class="text-center">{{ $item->type }}</td>

                                    <td class="text-center">
                                        @actions(['item'=>$item, 'route' => 'configurations','btns' => 'edit|delete'])
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
                    <div class="col-md-4 text-left">{{ $configurations->links() }}</div>
                    <div class="col-md-7 text-right paginate-count">{!! info_pages($configurations) !!}</div>
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
