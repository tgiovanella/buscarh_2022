@extends('user.layouts.html')


@section('container')

<div class="container" style="min-height: 62vh">
    <div class="row">
        <div class="col-sm-10 col-md-8 col-lg-6 mx-auto">

            <div class="d-block text-center">
                <a href="{{ route('user.home') }}">
                    <img class="img-fluid rounded mb-2" src="{{ asset('img/logoGigante.png') }}" width="100px" alt="">
                </a>

                <h1 class="mx-auto mb-1 mt-4 text-b-blue">Registrar-se</h1>

                <p class="text-muted mb-3">ou <a href="{{ route('user.login') }}" class="text-muted font-weight-bold"
                        style="text-decoration:underline">iniciar uma sessão</a></p>


                <form class="omb_loginForm" action="{{ route('user.register') }}" autocomplete="off" method="POST">
                    @csrf

                    <div class="input-group mb-2">
                        <div class="input-group-prepend ">
                            <div class="input-group-text rounded-0" style="width: 40px;"><i class="fa fa-user"></i>
                            </div>
                        </div>

                        <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                            name="name" placeholder="Nome" value="{{ old('email') }}" required autofocus>
                    </div>
                    @if ($errors->has('name'))
                    <span class="help-block" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif




                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text rounded-0" style="width: 40px;"><i class="fa fa-envelope"></i>
                            </div>
                        </div>

                        <input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                            name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
                    </div>
                    @if ($errors->has('email'))
                    <span class="help-block" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif

                    <div class="input-group  mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text rounded-0" style="width: 40px;"><i class="fa fa-lock"></i>
                            </div>
                        </div>
                        <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                            name="password" placeholder="Senha">
                    </div>
                    @if ($errors->has('password'))
                    <span class="help-block" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif


                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text rounded-0" style="width: 40px;"><i class="fa fa-lock"></i>
                            </div>
                        </div>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            placeholder="Confirmar Senha" required>
                    </div>

                    <button class="btn btn-lg btn-primary btn-block mt-2 mb-3" type="submit">Registrar</button>
                </form>

            </div>
        </div>
    </div>


</div>

@endsection

@section('content2')
<div class="omb_login">


    <div class="text-center mt-5">
        <a href="{{ route('user.home') }}">
            <img class="img-fluidrounded mb-2" src="{{ asset('img/logoGigante.png') }}" width="200px" alt="">
        </a>
    </div>

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Erro!</strong> {!! session('error') !!}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <h3 class="omb_authTitle">Já tem cadastro? <a href="{{ route('user.login') }}">Acesse aqui</a></h3>


    <div class="row omb_row-sm-offset-3">
        <div class="col-xs-12 col-sm-6">
            <form class="omb_loginForm" action="{{ route('user.register') }}" autocomplete="off" method="POST">
                @csrf

                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-user"></i></div>
                    </div>

                    <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                        placeholder="Nome" value="{{ old('email') }}" required autofocus>
                </div>
                @if ($errors->has('name'))
                <span class="help-block" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif




                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-envelope"></i></div>
                    </div>

                    <input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                        placeholder="Email" value="{{ old('email') }}" required autofocus>
                </div>
                @if ($errors->has('email'))
                <span class="help-block" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif

                <div class="input-group  mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-lock"></i></div>
                    </div>
                    <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                        name="password" placeholder="Senha">
                </div>
                @if ($errors->has('password'))
                <span class="help-block" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif


                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-lock"></i></div>
                    </div>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                        placeholder="Confirmar Senha" required>
                </div>

                <button class="btn btn-lg btn-primary btn-block mt-2 mb-3" type="submit">Registrar</button>
            </form>
        </div>
    </div>
</div>

@endsection
