@extends('user.layouts.html')


@section('container')

<div class="container" style="min-height: 62vh">
    <div class="row">
        <div class="col-sm-10 col-md-8 col-lg-6 mx-auto">

            <div class="d-block text-center">
                <a href="{{ route('user.home') }}">
                    <img class="img-fluid rounded mb-2" src="{{ asset('img/logoGigante.png') }}" width="100px" alt="">
                </a>

                <h1 class="mx-auto mb-1 mt-4 text-b-blue">Iniciar Sessão</h1>

                <p class="text-muted mb-3">ou <a href="{{ route('user.register') }}" class="text-muted font-weight-bold"
                        style="text-decoration:underline">criar uma
                        conta</a></p>



            </div>

            <form class="omb_loginForm" action="{{ route('user.login') }}" autocomplete="off" method="POST">
                @csrf
                <div class="input-group mb-2 rounded-0">
                    <div class="input-group-prepend rounded-0">
                        <div class="input-group-text rounded-0"><i class="fa fa-user"></i></div>
                    </div>

                    <input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                        placeholder="email address" value="{{ old('email') }}" required autofocus>
                </div>
                @if ($errors->has('email'))
                <span class="help-block" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif

                <div class="input-group">
                    <div class="input-group-prepend rounded-0">
                        <div class="input-group-text rounded-0"><i class="fa fa-lock"></i></div>
                    </div>
                    <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                        name="password" placeholder="Password">
                </div>
                @if ($errors->has('password'))
                <span class="help-block" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif

                <button class="btn btn-lg btn-primary btn-block mt-2" type="submit">Login</button>
            </form>

            <div class="row mt-2 text-muted">
                <div class="col-md-6">
                    <label class="form-check">
                        <input type="checkbox" value="remember-me" class="form-check-input">Permanecer Logado
                    </label>
                </div>
                <div class="col-md-6 text-right">
                    <a href="{{ route('user.password.request') }}" class="text-muted"
                        style="text-decoration:underline">Esqueceu a senha?</a>
                </div>
            </div>
        </div>
    </div>


</div>

@endsection
