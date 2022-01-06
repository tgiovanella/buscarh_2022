@if($method == 'create')
@php($action = route('admin.planes.store'))
@php($method_field = method_field('POST'))
@else
@php($action = route('admin.planes.update',$plane))
@php($method_field = method_field('PUT'))
@endif


@push('scripts')
<script src="{{ asset('adm/bower_components/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}">
</script>
<script>
    $(document).ready(function() {

    });
</script>
@endpush

@push('styles')
<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet"
    href="{{ asset('adm/bower_components/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">

@endpush




<form data-toggle="validator" role="form" method="POST" action="{{$action}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ $method_field }}




    <div class="row">
        <div class="form-group col-md-6 @if($errors->has('name')) has-error @endif">
            <label for="name">{{ __('general.name') }}</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $plane->name) }}"
                placeholder="{{ __('Descrição do Plano') }}" maxlength="191" required>
            <div class="help-block with-errors">{{ $errors->first('name') }}</div>
        </div>
    </div>



    <div class="row">
        <div class="form-group col-md-6 @if($errors->has('period')) has-error @endif">
            <label for="period">Período</label>
            <select class="form-control" name="period" id="period" required>
                <option value="">-- selecione um período </option>

                @foreach(App\Plane::PLANES as $item)
                <option value="{{ $item }}" @if($item==$plane->period) selected
                    @endif>{{ __('general.planes.' . $item) }}</option>
                @endforeach

            </select>
            <div class="help-block with-errors">{{ $errors->first('period') }}</div>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-4 @if($errors->has('amount_per_payment')) has-error @endif">
            <label for="amount_per_payment">{{ __('Valor por pagamento') }}</label>
            <input type="number" step="any" min="1" name="amount_per_payment" id="amount_per_payment"
                class="form-control" value="{{ old('amount_per_payment', $plane->amount_per_payment) }}"
                placeholder="{{ __('Insira o valor que será cobrado') }}" maxlength="191" required>
            <div class="help-block with-errors">{{ $errors->first('amount_per_payment') }}</div>
        </div>
    </div>


    <div class="row">
        <div class="form-group col-md-4 @if($errors->has('trial_period_duration')) has-error @endif">
            <label for="trial_period_duration">{{ __('Período de Teste (dias)') }}</label>
            <input type="number" step="1" min="0" name="trial_period_duration" id="trial_period_duration"
                class="form-control" value="{{ old('trial_period_duration', $plane->trial_period_duration) }}"
                placeholder="{{ __('Insira o valor em dias') }}" maxlength="191" required>
            <div class="help-block with-errors">{{ $errors->first('trial_period_duration') }}</div>
        </div>

        <div class="col-md-4 text-left">
            <p class="text-muted small">Exemplo de plano com período de teste.</p>
            <img src="{{ asset('img/pay/prazo_com_trial.png') }}" alt="Pagamento com Período de Teste"
                class="img-thumbnail" width="100%">
        </div>
        <div class="col-md-4 text-left">
            <p class="text-muted small">Exemplo de plano sem período de teste.</p>
            <img src="{{ asset('img/pay/prazo_sem_trial.png') }}" alt="Pagamento com Período de Teste"
                class="img-thumbnail" width="80%">
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-12 @if($errors->has('details')) has-error @endif">
            <label for="details">{{ __('Detalhes/Descrição') }}</label>
            <input type="text" name="details" id="details" class="form-control"
                value="{{ old('details', $plane->details) }}" placeholder="{{ __('Descrição detalhada') }}"
                maxlength="191">
            <div class="help-block with-errors">{{ $errors->first('details') }}</div>
        </div>
    </div>


    <div class="row">
        <div class="form-group col-md-12">
            <a href="{{ url()->previous() }}" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>
                Cancelar</a>
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Salvar</button>
        </div>
    </div>

</form>
