@extends('user.layouts.login')


@push('scripts')
    <script src="{{ asset('user/bower_components/jquery-mask-plugin/dist/jquery.mask.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#cpf').mask('000.000.000-00');
        });
    </script>
@endpush


@section('content')

    <div class="omb_login">



        <div class="text-center mt-5">
            <a href="{{ route('user.login') }}">
                <img class="img-fluid rounded mb-2" src="{{ asset('img/fenac-logo.png') }}" width="200px" alt="">
            </a>
        </div>


        <h3 class="omb_authTitle">{{ __('Redefinir a Senha') }}</h3>
        <p class="text-center small" style="color: #8c8c8c">Após redefinir a senha, um email será enviado para a sua
            <br />caixa de entrada com um link para que você possa redefinir a senha.
            <br />Caso não estiver na sua caixa de entrada, verifique também na lixeira/spam.
        </p>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {!! session('status')  !!}
                </div>
            @endif



            <form method="POST" action="{{ route('user.password.cpf') }}">
                @csrf

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('form.cpf') }}</label>

                    <div class="col-md-5">
                        <input id="cpf" type="text" class="form-control{{ $errors->has('cpf') ? ' is-invalid' : '' }}" name="cpf" value="{{ old('cpf') }}" placeholder="Digite o seu CPF aqui" required>

                        @if ($errors->has('cpf'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('cpf') }}</strong>
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
