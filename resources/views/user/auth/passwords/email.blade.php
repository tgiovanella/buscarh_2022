@extends('user.layouts.login')



@section('content')

<div class="omb_login">



    <div class="text-center mt-5">
        <a href="{{ route('user.login') }}">
            <img class="img-fluid rounded mb-2" src="{{ asset('img/logo.png') }}" width="200px" alt="">
        </a>
    </div>


    {{-- {{-- <h3 class="omb_authTitle">{{ __('Redefinir a Senha') }}</h3> --}}
    {{-- <p class="text-center small" style="color: #8c8c8c">Após redefinir a senha, um email será enviado para a sua --}}
    {{-- <br />caixa de entrada com um link para que você possa redefinir a senha.
            <br />Caso não estiver na sua caixa de entrada, verifique também na lixeira/spam.
            <br />Se você não lembra qual email utilizou para fazer registro,
            <br />utilize a opção de "Não lembra o email?" e redefina a senha com o seu CPF. --}}
    {{-- </p> --}}

    <div class="card-body">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif



        <form method="POST" action="{{ route('user.password.email') }}">
            @csrf

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Seu email') }}</label>

                <div class="col-md-5">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                        name="email" value="{{ old('email') }}" placeholder="Digite o seu email aqui" required>

                    @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-5 offset-md-4">
                    <button type="submit" class="btn btn-primary btn-block text-uppercase">
                        {{ __('Enviar o link de redefinição de senha') }}
                    </button>
                </div>
            </div>
        </form>
    </div>



    <div class="row omb_row-sm-offset-3 mt-2 mb-3">

        <div class="col-xs-12 col-sm-6">
            <p class="text-right">
                <a href="{{ route('user.login') }}">Voltar para o site</a>
            </p>
        </div>

    </div>
</div>


@endsection
