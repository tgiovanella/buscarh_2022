@extends('admin.layouts.login')

@section('content')

    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Faça login para iniciar a sessão</p>

        <form action="{{ route('admin.login') }}" method="post" class="form">
            @csrf
            <div class="form-group has-feedback">
                <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email">

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif

            </div>
            <div class="form-group has-feedback">
                <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password">
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Manter conectado
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
                </div>
                <!-- /.col -->
            </div>

        </form>
    </div>
    <!-- /.login-box-body -->
@endsection
