@if($method == 'create')
@php($action = route('admin.navs.store'))
@php($method_field = method_field('POST'))
@else
@php($action = route('admin.navs.update',$nav))
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
            <label for="page_block_id">Bloco</label>
            <select class="form-control" name="page_block_id" id="page_block_id">
                <option value="">-- selecione um bloco --</option>
                @forelse ($blocks as $item)
                <option value="{{ $item->id }}" @if($item->id == $nav->page_block_id) selected @endif>{{ $item->name }}
                </option>
                @empty

                @endforelse
            </select>
            <div class="help-block with-errors">{{ $errors->first('page_block_id') }}</div>

        </div>
    </div>


    <div class="row">
        <div class="form-group col-md-6 @if($errors->has('name')) has-error @endif">
            <label for="name">{{ __('Nome') }}</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $nav->name) }}"
                placeholder="{{ __('Insira o Nome') }}" maxlength="191" required>
            <div class="help-block with-errors">{{ $errors->first('url') }}</div>
        </div>
    </div>


    <div class="row">
        <div class="form-group col-md-6 @if($errors->has('url')) has-error @endif">
            <label for="name">{{ __('URL') }}</label>
            <input type="text" name="url" id="url" class="form-control" value="{{ old('url', $nav->url) }}"
                placeholder="{{ __('Insira a URL') }}" maxlength="191" required>
            <div class="help-block with-errors">{{ $errors->first('url') }}</div>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6 @if($errors->has('slug')) has-error @endif">
            <label for="name">{{ __('Slug') }}</label>
            <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug', $nav->slug) }}"
                placeholder="{{ __('Insira a URL') }}" maxlength="191" required>
            <div class="help-block with-errors">{{ $errors->first('slug') }}</div>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6 @if($errors->has('order')) has-error @endif">
            <label for="order">{{ __('Ordem') }}</label>
            <input type="number" min="0" max="99" name="order" id="order" class="form-control"
                value="{{ old('order', $nav->order) }}" placeholder="{{ __('Insira a ordem de 0 a 99') }}"
                maxlength="191" required>
            <div class="help-block with-errors">{{ $errors->first('order') }}</div>
        </div>
    </div>


    <div class="row">
        <div class="form-group col-md-12 @if($errors->has('title')) has-error @endif">
            <label for="title">{{ __('Observação') }}</label>

            <textarea class="form-control" placeholder="{{ __('Insira o conteúdo da página') }}" name="observation"
                id="observation">{!! old('observation', $nav->observation) !!}</textarea>
            <div class="help-block with-errors">{{ $errors->first('title') }}</div>
        </div>
    </div>


    <div class="row" style="margin-bottom: 10px;">

        <div class="col-md-12 form-group @if($errors->has('status')) has-error @endif"">
            <label for="status">Status</label>
            <div class="form-check  form-check-inline">
                <label class="form-check-label" style="margin-right: 10px;">
                    <input class="form-check-input" type="radio" name="status" id="status" value="1" @if($nav->status == 1) checked @endif required> Ativo
                </label>

                <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="status" id="status" value="0" @if($nav->status ==
                    0 && isset($nav->status)) checked @endif required> Inativo
                </label>
            </div>
            <div class="help-block with-errors">{{ $errors->first('status') }}</div>
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
