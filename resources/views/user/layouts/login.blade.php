<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('name_festival','Busca RH') - @yield('title','Login')</title>

    <!-- css -->
    <link href="{{ asset('user/bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('user/bower_components/font-awesome/css/font-awesome.min.css') }}">


    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">


    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,400i,700,700i,900&display=swap&subset=latin-ext"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/login.css') }}">


    @stack('styles')



</head>

<body id="">
    <div class="container">
        @yield('content')
    </div>

    <script src="{{ asset('user/bower_components/jquery/dist/jquery.min.js') }}"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    {{-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-133853902-1"></script> --}}
    <script>
        // window.dataLayer = window.dataLayer || [];
        // function gtag(){dataLayer.push(arguments);}
        // gtag('js', new Date());

        // gtag('config', 'UA-133853902-1');
    </script>

    @stack('scripts')
</body>

</html>
