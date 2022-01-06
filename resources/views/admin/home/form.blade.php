@if($method == 'create')
    @php($action = route('admin.instruments.store'))
    @php($method_field = method_field('POST'))
@else
    @php($action = route('admin.instruments.update',$instrument->id))
    @php($method_field = method_field('PUT'))
@endif


<form data-toggle="validator" role="form" method="POST" action="{{$action}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ $method_field }}



    <div class="row">
        <div class="form-group col-md-6 @if($errors->has('name')) has-error @endif">
            <label for="name">{{ __('form.name_simple') }}</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $instrument->name) }}" placeholder="{{ __('form.name_instrument_placeholder') }}" min="1" required>
            <div class="help-block with-errors">{{ $errors->first('name') }}</div>
        </div>
    </div>





    <div class="row">
        <div class="form-group col-md-12">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Salvar</button>
        </div>
    </div>

</form>