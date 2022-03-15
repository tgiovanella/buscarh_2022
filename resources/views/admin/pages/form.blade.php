@if($method == 'create')
@php($action = route('admin.pages.store'))
@php($method_field = method_field('POST'))
@else
@php($action = route('admin.pages.update',$page))
@php($method_field = method_field('PUT'))
@endif


@push('scripts')
<script src="{{ asset('adm/bower_components/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
@endpush

@push('styles')
 <!-- bootstrap wysihtml5 - text editor -->
 <link rel="stylesheet" href="{{ asset('adm/bower_components/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">

@endpush




<form data-toggle="validator" role="form" method="POST" action="{{$action}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ $method_field }}




    <div class="row">
        <div class="form-group col-md-6 @if($errors->has('title')) has-error @endif">
            <label for="title">{{ __('general.title') }}</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $page->title) }}"
                placeholder="{{ __('Insira o título da página') }}" maxlength="191" required>
            <div class="help-block with-errors">{{ $errors->first('title') }}</div>
        </div>
    </div>


    <div class="row">
        <div class="form-group col-md-12 @if($errors->has('title')) has-error @endif">
            <label for="title">{{ __('general.body') }}</label>

            <textarea class="form-control" placeholder="{{ __('Insira o conteúdo da página') }}" name="body" id="body"
                rows="20" required>{!! old('body', $page->body) !!}</textarea>
            <div class="help-block with-errors">{{ $errors->first('title') }}</div>
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
