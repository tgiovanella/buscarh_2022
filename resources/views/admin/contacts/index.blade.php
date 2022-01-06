@extends('admin.layouts.app')

@section('title',__('Contatos'))



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
                        <form class="form form-search" method="GET"  action="">
                            <strong>Filtros</strong>
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label class="sr-only" for="date">Data</label>
                                    <input type="date" class="form-control" id="date" name="date"
                                        value="{{ old('date',request('date')) }}" placeholder="Data">
                                </div>

                                <div class="form-group col-md-3">
                                    <label class="sr-only" for="name">Nome</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name',request('name')) }}" placeholder="Nome">
                                </div>

                                <div class="form-group col-md-3">
                                    <label class="sr-only" for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email',request('email')) }}" placeholder="Email">
                                </div>

                                <div class="form-group col-md-2">
                                    <label class="sr-only" for="status">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="">{{ __('general.select_options') }}</option>
                                        {!! array_combo(__('general.status_contact'), old('status',request('status')) ) !!}
                                    </select>
                                </div>

                                <div class="col-md-2 text-right">
                                    <button type="submit" class="btn btn-success">Buscar</button>
                                    <a href="{{ route('admin.contacts.index') }}" class="btn btn-warning">Limpar</a>
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
                                    <th>Data</th>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center" style="width: 10%">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($contacts as $contact)
                                <tr>
                                    <td>{{ $contact->id }}</td>
                                    <td>{{ convertDateTimeUS2BR($contact->created_at) }}</td>
                                    <td>{{ $contact->name }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td class="text-center"> {!!
                                        labels($contact->status,'general.status_contact','myconfig.colors_status') !!}
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="{{ route('admin.contacts.show',$contact) }}"
                                                class="btn btn-xs btn-default" data-toggle="tooltip"
                                                title="Visualizar"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5">
                                        não tem
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
                    <div class="col-md-4 text-left">{{ $contacts->links() }}</div>
                    <div class="col-md-7 text-right paginate-count">{!! info_pages($contacts) !!}</div>
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
