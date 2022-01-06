<form action="{{ route('user.claims.store') }}" method="post" data-toggle="validator" role="form" class="form">


    @csrf
    <div class="form-group  @if($errors->has('name')) has-error @endif">
        <label for="name">Nome Completo</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Seu nome" required>
        <div class="help-block with-errors">{{ $errors->first('name') }}</div>

    </div>

    <div class="row">
        <div class="form-group col-md-4 @if($errors->has('cpf')) has-error @endif">
            <label for="cpf">CPF</label>
            <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Seu CPF" required>
            <div class="help-block with-errors">{{ $errors->first('cpf') }}</div>

        </div>

        <div class="form-group col-md-4 @if($errors->has('rg_cnh')) has-error @endif">
            <label for="rg_cnh">RG/CNH</label>
            <input type="text" class="form-control" id="rg_cnh" name="rg_cnh" placeholder="Seu RG ou CNH" required>
            <div class="help-block with-errors">{{ $errors->first('rg_cnh') }}</div>

        </div>



    </div>

    <div class="row">

        <div class="form-group col-md-8  @if($errors->has('company')) has-error @endif">
            <label for="company">Nome da Empresa</label>
            <input type="text" class="form-control" id="company" name="company"
                placeholder="Nome da empresa reividicada" required>
            <div class="help-block with-errors">{{ $errors->first('company') }}</div>

        </div>

        <div class="form-group col-md-4  @if($errors->has('cnpj')) has-error @endif">
            <label for="cnpj">CNPJ</label>
            <input type="text" class="form-control" id="cnpj" name="cnpj" placeholder="O CNPJ da sua empresa" required>
            <div class="help-block with-errors">{{ $errors->first('cnpj') }}</div>

        </div>
    </div>



    <div class="row">
        <div class="form-group col-12 text-right">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </div>

</form>
