@if($method == 'create')
@php($action = route('admin.configurations.store'))
@php($method_field = method_field('POST'))
@else
@php($action = route('admin.configurations.update',$configuration))
@php($method_field = method_field('PUT'))
@endif


@push('scripts')
<script>
    $(document).ready(function() {
            //busca cidade
        });
</script>
@endpush




<form data-toggle="validator" role="form" method="POST" action="{{$action}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ $method_field }}




    <div class="row">
        <div class="form-group col-md-6 @if($errors->has('name')) has-error @endif">
            <label for="name">{{ __('Nome') }}</label>
            <input type="text" name="name" id="name" class="form-control"
                value="{{ old('name', $configuration->name) }}" placeholder="{{ __('Inserir somente letras, números e underline.') }}"
                maxlength="191" pattern="^[A-Za-z0-9_]*\d|[A-Za-z0-9_]*$" required>
            <div class="help-block with-errors">{{ $errors->first('name') }}</div>
        </div>
    </div>


    <div class="row">
        <div class="form-group col-md-6 @if($errors->has('value')) has-error @endif">
            <label for="value">{{ __('Valor') }}</label>
            <input type="text"  name="value" id="value" class="form-control"
                value="{{ old('value', $configuration->value) }}" placeholder="{{ __('Insira o valor') }}"
                maxlength="191" required>
            <div class="help-block with-errors">{{ $errors->first('value') }}</div>
        </div>
    </div>




    <div class="row">
        <div class="form-group col-md-12 @if($errors->has('descriptions')) has-error @endif">
            <label for="answer">{{ __('Descrição') }}</label>

            <textarea class="form-control" placeholder="{{ __('Insira uma breve descrição') }}" name="descriptions" id="descriptions"
                rows="5" >{!! old('descriptions', $configuration->description) !!}</textarea>
            <div class="help-block with-errors">{{ $errors->first('descriptions') }}</div>
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
