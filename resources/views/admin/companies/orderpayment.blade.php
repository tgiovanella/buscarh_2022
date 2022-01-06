@if($method == 'create')
@php($action = route('admin.companies.store'))
@php($method_field = method_field('POST'))
@else
@php($action = route('admin.companies.update',$company->id))
@php($method_field = method_field('PUT'))
@endif


@push('scripts')

@endpush


{{-- <form data-toggle="validator" role="form" method="POST" action="{{$action}}" enctype="multipart/form-data">
{{ csrf_field() }}
{{ $method_field }}


<div class="row">
    <div class="form-group col-md-12 @if($errors->has('plane_id')) has-error @endif">
        <label for="plane_id">Plano de Assinatura</label>
        <select class="form-control" name="plane_id" id="plane_id" required>
            <option value="">-- selecione um plano --</option>
            @forelse ($planes as $key => $item)
            <option value="{{ $key }}">{{ $item->name }} -
                {{ $item->amount_per_payment }} R$ {{ __('general.planes.'. $item->period) }} com
                {{ $item->trial_period_duration }} dias de teste.</option>
            @empty

            @endforelse
        </select>
        <div class="help-block with-errors">{{ $errors->first('position') }}</div>
    </div>
</div>


<div class="row">
    <div class="form-group col-md-12">
        <a href="{{ url()->previous() }}" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>
            Cancelar</a>
        <button type="submit" class="btn btn-primary"><i class="fa fa-envelope"></i> Enviar Fatura</button>
    </div>
</div>
</form> --}}

<div class="row">
    <div class="col-md-12">
        <h5>Histórico</h5>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Plano</th>
                    <th>Período</th>
                    <th>Valor</th>
                    <th>Teste</th>
                    <th>Data Adesão</th>
                    <th>Data Cancelamento</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
