@extends('user.layouts.html')
@section('container')
<div class="container-fluid">
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header text-center">
                <h4>Propostas</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Empresa Prestadora</th>
                            <th>Preço proposta</th>
                            <th>Data entrega</th>
                            <th class="text-center">Cidade</th>
                            <th class="text-center">Telefone</th>
                            <th class="text-center">E-mail</th>
                            <th class="text-center">Observações</th>
                            <th class="text-center">Anexos</th>
                            <th class="text-center">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($quotes_avalaibles->candidates as $item)
                        <tr>
                            <td width="80">{{ $item->id }}</td>
                            <td width="20%">{{ $item->company->name  }}</td>
                            <td>
                                {{ number_format($item->price,2,',','.')  }}
                            </td>
                            <td>
                                {{date('d-m-Y',strtotime($item->deadline))}}
                            </td>
                            <td class="text-center">{{$item->company->city->title}} / {{$item->company->uf}} </td>
                            <td class="text-center">{{$item->company->phone}} </td>
                            <td class="text-center">{{$item->company->email}} </td>
                            <td class="text-center"><i class="fa fa-comment" aria-hidden="true"></i> </td>
                            <td class="text-center"><i class="fa fa-file" aria-hidden="true"></i> </td>

                            <td width="120" class="text-center">
                                <a href="{{route('user.candidate',[$item->id])}}" class="btn btn-sm btn-info text-white" title="Visualizar Proposta Completa"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@push('scripts')

<script>
    $(function() {
        $('.card-body').css('height', window.innerHeight - (window.innerHeight * 0.45))
    })
</script>
@endpush