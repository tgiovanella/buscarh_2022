@php
// $action = route('user.reports.store',$company);
$action = $type == 'company' ? route('user.reports.store',$company) : route('user.ads-reports.store');
@endphp

<form action="{{ $action  }}" method="post" id="frmReportCompanies" data-toggle="validator" role="form">
    @csrf


    {{-- <input type="hidden" name="type" id="type" value="{{ $type }}"> --}}

    @if($type == 'ads')
    <div class="form-group @if($errors->has('advert_id')) has-error @endif">
        <label for="name">Anúncio</label>
        <select type="text" class="form-control" id="advert_id" name="advert_id" required>
            <option value="">-- selecione o anúncio --</option>
            @forelse ($ads as $item)
            <option value="{{ $item->id }}">{{ $item->title }} - {{ @$item->configuration->title }}</option>
            @empty

            @endforelse
        </select>
        <div class="help-block with-errors">{{ $errors->first('advert_id') }}</div>
    </div>
    @endif

    <div class="form-group @if($errors->has('name')) has-error @endif">
        <label for="name">Nome</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Seu nome" value="{{ old('name') }}"
            autocomplete="off" required>
        <div class="help-block with-errors">{{ $errors->first('name') }}</div>
    </div>

    <div class="form-group @if($errors->has('cpf_cnpj')) has-error @endif">
        <label for="cpf_cnpj">CPF/CNPJ</label>
        <input type="text" class="form-control" id="cpf_cnpj" name="cpf_cnpj" placeholder="Seu CPF/CNPJ"
            value="{{ old('cpf_cnpj') }}" autocomplete="off" required>
        <div class="help-block with-errors">{{ $errors->first('cpf_cnpj') }}</div>

    </div>

    <div class="form-group @if($errors->has('email')) has-error @endif">
        <label for="email">Endereço de Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Seu email"
            value="{{ old('email') }}" autocomplete="off" required>
        <div class="help-block with-errors">{{ $errors->first('email') }}</div>

    </div>

    <div class="form-group @if($errors->has('email')) has-error @endif">
        <label for="email">Motivo</label>
        <div class=" btn-group-toggle" data-toggle="buttons">
            <label class="btn btn-outline-info btn-sm mb-2">
                <input type="radio" name="tag" id="option1" name="tag" value="{{ App\Report::TAG_FALSE_DATA }}"
                    autocomplete="off" required> Dados Falso
            </label>
            <label class="btn btn-outline-info btn-sm mb-2">
                <input type="radio" name="tag" id="option2" name="tag" value="{{ App\Report::TAG_COMPANY_NOT_EXIST }}"
                    autocomplete="off" required> Empresa não existe
            </label>
            <label class="btn btn-outline-info btn-sm mb-2">
                <input type="radio" name="tag" id="option3" name="tag"
                    value="{{ App\Report::TAG_DATA_FROM_ANOTHER_PERSON }}" autocomplete="off" required> Uso de dados de
                propriedades de outras pessoas
            </label>
            <label class="btn btn-outline-info btn-sm mb-2">
                <input type="radio" name="tag" id="option4" name="tag" value="{{ App\Report::TAG_MISLEADING_CONTENT }}"
                    autocomplete="off" required> Conteúdo enganoso
            </label>
            <label class="btn btn-outline-info  btn-sm mb-2">
                <input type="radio" name="tag" id="option5" name="tag"
                    value="{{ App\Report::TAG_INAPPROPRIATE_CONTENT }}" autocomplete="off" required> Conteúdo impróprio
            </label>
            <label class="btn btn-outline-info btn-sm mb-2">
                <input type="radio" name="tag" id="option6" name="tag" value="{{ App\Report::TAG_OTHERS }}"
                    autocomplete="off" required> Outros
            </label>
        </div>
        <div class="help-block with-errors">{{ $errors->first('tag') }}</div>

    </div>

    <div class="form-group @if($errors->has('observation')) has-error @endif">
        <label for="observation">Observação</label>
        <textarea class="form-control" name="observation" required>{{ old('observation') }}</textarea>
    </div>


    <div class="form-group @if($errors->has('g-recaptcha-response')) has-error @endif">
        {!! Recaptcha::render() !!}
        <div class="help-block with-errors">{{ $errors->first('g-recaptcha-response') }}</div>
    </div>



    <hr>
    <div class="text-right">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
    </div>


</form>
