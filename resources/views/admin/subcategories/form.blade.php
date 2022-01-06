@if($method == 'create')
@php($action = route('admin.subcategories.store'))
@php($method_field = method_field('POST'))
@else
@php($action = route('admin.subcategories.update',$subcategory))
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
                value="{{ old('name', $subcategory->name) }}" placeholder="{{ __('general.description_place') }}"
                maxlength="191" required>
            <div class="help-block with-errors">{{ $errors->first('name') }}</div>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6 @if($errors->has('name')) has-error @endif">
            <label for="name">{{ __('general.subcategories') }}</label>
            <select name="category_id" id="category_id" class="form-control" required>
                <option value="">{{ __('general.select_options') }}</option>
                @foreach($categories as $item)
                <option value="{{ $item->id }}" @if($item->id == @$subcategory->category->id) selected @endif>{{ $item->name }}</option>
                @endforeach
            </select>
            <div class="help-block with-errors">{{ $errors->first('name') }}</div>
        </div>
        <div class="form-group col-md-6" style="margin-top: 25px">
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary" ><i class="fa fa-plus" aria-hidden="true"></i></a>
            {{-- <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#frmCategory"><i class="fa fa-plus" aria-hidden="true"></i></a> --}}
        </div>
    </div>


    <div class="row">
        <div class="form-group col-md-12">
        <a href="{{ url()->previous() }}" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</a>
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Salvar</button>
        </div>
    </div>

</form>


<!-- Modal -->
<div class="modal fade" id="frmCategory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Categoria (resumido)</h4>
    </div>
    <div class="modal-body">
        <form action="" method="post" data-toggle="validator" role="form">
            {{ csrf_field() }}

            <div class="row">
                <div class="form-group col-md-12 @if($errors->has('name')) has-error @endif">
                    <label for="name">{{ __('general.description') }}</label>
                    <input type="text" name="name" id="name" class="form-control"
                        value="{{ old('name', $subcategory->name) }}" placeholder="{{ __('general.description_place') }}"
                        maxlength="191" required>
                    <div class="help-block with-errors">{{ $errors->first('name') }}</div>
                </div>
            </div>

        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success"><i class="fa fa-save"></i> Salvar</button>
    </div>
    </div>
</div>
</div>
