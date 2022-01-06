@if($method == 'create')
@php($action = route('admin.users.store'))
@php($method_field = method_field('POST'))
@else
@php($action = route('admin.users.update',$user))
@php($method_field = method_field('PUT'))
@endif


@push('scripts')
<script>
    $(document).ready(function() {

    });
</script>
@endpush




<form data-toggle="validator" role="form" method="POST" action="{{$action}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ $method_field }}

    @csrf
    {{ method_field('PUT')}}


    @if(\request('token'))
    <input type="hidden" name="token_payment" value="{{ \request('token') }}">
    @endif
    <div class="form-group">
        <label for="name" class="control-label font-weight-bold">
            Nome <span class="required" title="Obrigatório">*</span>
        </label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Seu nome"
            title="Entre com o seu nome." value="{{ old('name',$user->name) }}" required autofocus>
        <div class="help-block with-errors text-danger">{{ $errors->first('name') }}</div>
    </div>

    <div class="form-group">
        <label for="email" class="control-label font-weight-bold">
            Email <span class="required" title="Obrigatório">*</span>
        </label>
        <input type="email" class="form-control" name="email" id="email" placeholder="Seu email"
            title="Entre com o seu email." value="{{ old('email',$user->email) }}" required>
        <div class="help-block with-errors text-danger">{{ $errors->first('email') }}</div>

    </div>

    <div class="row">
        <div class="form-group col-md-3">
            <label for="cpf" class="control-label font-weight-bold">
                CPF
            </label>
            <input type="text" class="form-control" name="cpf" id="cpf" placeholder="Seu CPF"
                title="Entre com o seu CPF." value="{{ old('cpf',$user->cpf) }}" required>
            <div class="help-block with-errors"></div>
        </div>

        <div class="form-group col-md-4">
            <label for="birth" class="control-label font-weight-bold">
                Aniversário
            </label>
            <input type="date" class="form-control" name="birth" id="birth" placeholder="Seu cpf"
                title="Entre com o seu aniversário." value="{{ old('birth',$user->birth) }}" required>
            <div class="help-block with-errors"></div>
        </div>
    </div>

    <div class="form-group">
        <label for="phone" class="control-label font-weight-bold">
            Telefone
        </label>
        <input type="text" class="form-control" name="phone" id="phone" placeholder="Seu telefone" required
            title="Entre com o seu telefone." value="{{ old('phone',$user->phone) }}">
        <div class="help-block with-errors"></div>
    </div>

    <div class="row">
        <div class="form-group col-md-8">
            <label for="street" class="control-label font-weight-bold">
                Rua
            </label>
            <input type="text" class="form-control" name="street" id="street" placeholder="Sua Rua"
                title="Entre com a sua Rua." value="{{ old('street',$user->street) }}" required>
            <div class="help-block with-errors"></div>
        </div>

        <div class="form-group col-md-4">
            <label for="number" class="control-label font-weight-bold">
                Número
            </label>
            <input type="text" class="form-control" name="number" id="street" placeholder="Seu número"
                title="Entre com o seu número." value="{{ old('number',$user->number) }}" required>
            <div class="help-block with-errors"></div>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-4">
            <label for="destrict" class="control-label font-weight-bold">
                Bairro
            </label>
            <input type="text" class="form-control" name="destrict" id="destrict" placeholder="Seu bairro"
                title="Entre com o seu bairro." value="{{ old('destrict',$user->destrict) }}" required>
            <div class="help-block with-errors"></div>
        </div>

        <div class="form-group col-md-4">
            <label for="complement" class="control-label font-weight-bold">
                Complemento
            </label>
            <input type="text" class="form-control" name="complement" id="complement" placeholder="Seu complemento"
                title="Entre com o seu complemento." value="{{ old('complement',$user->complement) }}">
            <div class="help-block with-errors"></div>
        </div>

        <div class="form-group col-md-4">
            <label for="cep" class="control-label font-weight-bold">
                CEP
            </label>
            <input type="text" class="form-control" name="cep" id="cep" placeholder="Seu CEP"
                title="Entre com o seu CEP." value="{{ old('cep',$user->cep) }}" required>
            <div class="help-block with-errors"></div>
        </div>


    </div>

    <div class="row">
        <div class="form-group col-md-6 @if($errors->has('city_id')) has-error @endif">
            <label for="city_id">{{ __('Cidade/UF') }}</label>


            <select class="form-control select-ajax-cities" name="city_id" id="city_id">
                @if($user->city_id)
                <option value="{{ $user->city->id }}" selected>{{ $user->city->title }}/{{ $user->city->state->letter }}
                <option>
                    @endif
            </select>
            <div class="help-block with-errors">{{ $errors->first('city_id') }}</div>
        </div>
    </div>


    <hr>

    <div class="form-group">
        <label for="password" class="control-label font-weight-bold">
            Senha
        </label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Sua nova senha"
            title="Entre com uma nova senha." autocomplete="off" minlength="8">
        <div class="help-block with-errors"></div>
    </div>

    <div class="row">
        <div class="form-group col-md-12">
            <a href="{{ url()->previous() }}" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>
                Cancelar</a>
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Salvar</button>
        </div>
    </div>

</form>


