<form action="{{ route('user.contacts.store') }}" method="post">


    @csrf
    <div class="form-group  @if($errors->has('name')) has-error @endif">
        <label for="name">Nome Completo</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Seu nome" required>
        <div class="help-block with-errors">{{ $errors->first('name') }}</div>

    </div>

    <div class="form-group  @if($errors->has('email')) has-error @endif">
        <label for="emal">Endereço de email</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Seu email"
            required>
        <small id="emailHelp" class="form-text text-muted">Nunca vamos compartilhar seu email, com ninguém.</small>
        <div class="help-block with-errors">{{ $errors->first('email') }}</div>

    </div>

    <div class="form-group  @if($errors->has('subject')) has-error @endif">
        <label for="subject">Assunto</label>
        <input type="text" class="form-control" id="subject" name="subject" placeholder="Assunto que você quer tratar" required>
        <div class="help-block with-errors">{{ $errors->first('subject') }}</div>

    </div>

    <div class="form-group  @if($errors->has('message')) has-error @endif">
        <label for="message">Mensagem</label>
        <textarea class="form-control" name="message" id="message" ows="3" placeholder="Escreva a sua mensagem"
            required></textarea>
        <div class="help-block with-errors">{{ $errors->first('message') }}</div>

    </div>

    <div class="form-group @if($errors->has('g-recaptcha-response')) has-error @endif">
        <div>
                {!! Recaptcha::render() !!}
        </div>
        <div class="help-block with-errors">{{ $errors->first('g-recaptcha-response') }}</div>
    </div>


    <div class="text-right">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</form>
