@if($method == 'create')
@php($action = route('admin.categories.store'))
@php($method_field = method_field('POST'))
@else
@php($action = route('admin.categories.update',$category->id))
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
            <label for="name">{{ __('general.description') }}</label>
            <input type="text" name="name" id="name" class="form-control"
                value="{{ old('name', $category->name) }}" placeholder="{{ __('general.description_place') }}"
                maxlength="191" required>
            <div class="help-block with-errors">{{ $errors->first('name') }}</div>
        </div>
    </div>




    <div class="row">
        <div class="form-group col-md-12">
        <a href="{{ url()->previous() }}" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</a>
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Salvar</button>
        </div>
    </div>

</form>

