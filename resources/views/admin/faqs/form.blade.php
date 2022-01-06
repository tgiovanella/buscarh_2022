@if($method == 'create')
@php($action = route('admin.faqs.store'))
@php($method_field = method_field('POST'))
@else
@php($action = route('admin.faqs.update',$faq))
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
        <div class="form-group col-md-12 @if($errors->has('question')) has-error @endif">
            <label for="answer">{{ __('Pergunta') }}</label>

            <textarea class="form-control" placeholder="{{ __('Insira uma pergunta') }}" name="question" id="question"
                rows="10" required>{!! old('question', $faq->question) !!}</textarea>
            <div class="help-block with-errors">{{ $errors->first('question') }}</div>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-12 @if($errors->has('answer')) has-error @endif">
            <label for="answer">{{ __('Resposta') }}</label>

            <textarea class="form-control" placeholder="{{ __('Insira a resposta da pergunta') }}" name="answer" id="answer"
                rows="10" required>{!! old('answer', $faq->answer) !!}</textarea>
            <div class="help-block with-errors">{{ $errors->first('answer') }}</div>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6 @if($errors->has('order')) has-error @endif">
            <label for="order">{{ __('Ordem') }}</label>
            <input type="number" min="0" max="99" name="order" id="order" class="form-control"
                value="{{ old('order', $faq->order) }}" placeholder="{{ __('Ordem de 0 a 99') }}"
                maxlength="191" required>
            <div class="help-block with-errors">{{ $errors->first('order') }}</div>
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
