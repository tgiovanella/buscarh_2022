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
                    @if($quotes_avalaibles->candidates->count() > 0)
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
                            @foreach ($quotes_avalaibles->candidates->groupBy('company_id') as $item)
                            <tr>
                                <td width="80">{{ $item->first()->id }}</td>
                                <td width="20%">{{ $item->first()->company->name  }}</td>
                                <td>
                                    {{ number_format($item->first()->price,2,',','.')  }}
                                </td>
                                <td>
                                    {{date('d-m-Y',strtotime($item->first()->deadline))}}
                                </td>
                                <td class="text-center">{{$item->first()->company->city->title}} / {{$item->first()->company->uf}} </td>
                                <td class="text-center">{{$item->first()->company->phone}} </td>
                                <td class="text-center">{{$item->first()->company->email}} </td>
                                <!-- link da interacao entre empresa e candidato -->
                                <td class="text-center"><i class="fa fa-comment" aria-hidden="true"></i> {{$item->count()}} </td>
                                <td class="text-center">
                                    @if($item->first()->path_file)
                                    <a title="Baixar anexo Proposta" href="{{ Storage::disk('public')->url($item->first()->path_file) }}" download>
                                        <i class="fa fa-file text-info" aria-hidden="true"></i>
                                    </a>
                                    @else
                                    -
                                    @endif
                                </td>

                                <td width="120" class="text-center">
                                    <!-- link do formulario aqui -->
                                    <a href="#" class="btn btn-sm btn-info text-white" title="Visualizar Proposta Completa"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="alert alert-warning" role="alert">
                        Ainda não existem propostas.
                    </div>
                    @endif
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