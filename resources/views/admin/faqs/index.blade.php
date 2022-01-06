@extends('admin.layouts.app')

@section('title',__('FAQs'))



@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">@yield('title')</h3>
                <div class="box-tools pull-right">
                    <a href="{{ route('admin.faqs.create') }}" class="btn btn-sm btn-primary"><i
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
                                    <th>Pergunta</th>
                                    <th>Ordem</th>
                                    <th>Slug</th>
                                    <th class="text-center">Status</th>

                                    <th class="text-center" style="width: 10%">Ação</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($faqs as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->question }}</td>
                                    <td>{{ $item->order }}</td>
                                    <td>{{ $item->slug }}</td>
                                    <td class="text-center">{{ $item->status }}</td>

                                    <td class="text-center">
                                        @actions(['item'=>$item, 'route' => 'faqs','btns' => 'edit|delete'])
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
                    <div class="col-md-4 text-left">{{ $faqs->links() }}</div>
                    <div class="col-md-7 text-right paginate-count">{!! info_pages($faqs) !!}</div>
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
