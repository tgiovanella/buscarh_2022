<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <!-- <script data-ad-client="ca-pub-6634788735907899" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> -->
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" id="csrf-token">

   



    @if(Auth::user())
    <meta name="auth-user-name" content="{{ Auth::user()->name }}" id="auth-user-name">
    <meta name="auth-user-email" content="{{ Auth::user()->email }}" id="auth-user-email">
    @endif

    <meta name="language" content="pt-BR">
    <title>{{ __('Busca RH Web') }} - @yield('title','Home')</title>
    <meta name="description" content="O melhor site de busca de Fornecedores para RH. Somos uma empresa que ajuda as pessoas e áreas de RH.">
    <meta name="robots" content="all">
    <meta name="author" content="Busca RH Web">
    <meta name="keywords" content="profissionais de rh, consultorias de rh, empresas de rh, consultoria de rh">

    <meta property="og:type" content="page">
    <meta property="og:url" content="https://www.facebook.com/BuscaRHweb/">
    <meta property="og:title" content="Busca RH Web">
    <meta property="og:image" content="https://www.buscarhweb.com.br/img/logoGigante.png">
    <meta property="og:description" content="O melhor site de busca de Fornecedores para RH. Somos uma empresa que ajuda as pessoas e áreas de RH.">

    <meta property="article:author" content="Busca RH Web">
    <meta name="google-site-verification" content="hQG1J0lmg_qpPYx-G78IivmyqjNxwTWZd11jly6mpqo" />
    <meta name="google-site-verification" content="2nv6P8H6o3QpuCZIPSaLBEZokotu4zy9FGAhHl5f_Jc" />


    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Busca RH Web">
    <meta name="twitter:description" content="O melhor site de busca de Fornecedores para RH. Somos uma empresa que ajuda as pessoas e áreas de RH.">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- css -->
    <link rel="stylesheet" href="{{ asset('user/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/bower_components/jquery-confirm2/dist/jquery-confirm.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/bower_components/slick-carousel/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('user/bower_components/slick-carousel/slick/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('user/bower_components/select2/dist/css/select2.min.css') }}">



    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,400i,700,700i,900&display=swap&subset=latin-ext"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="{{ asset('user/css/stackBorderBox.css') }}" rel="stylesheet" type="text/css">
   <link href="/user/css/sidebar.css" rel="stylesheet" type="text/css">


    @stack('styles')



</head>

<body>


    <div class="waraper">
        <nav id="navPrincipal" class="navbar navbar-expand-lg navbar-dark bg-b-blue fixed-top sombraNav">
            <a class="navbar-brand" href="{{ route('user.home') }}">
                <img src="{{ asset('img/logoBrancoMini.png') }}" class="img-fluid" id="navLogo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Alterna navegação">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.home') }}">Inicial<span class="sr-only">(Página
                                atual)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="ddInstitucional" role="button" aria-haspopup="true"
                            aria-expanded="false" data-toggle="dropdown" href="#">Institucional</a>
                        <div class="dropdown-menu bg-b-blue" aria-labelledby="ddInstitucional">
                            {!! app(App\Http\Controllers\User\NavigationController::class)->getMenu(1,'main') !!}
                        </div>
                    </li>
                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="ddContato" role="button" aria-haspopup="true"
                            aria-expanded="false" data-toggle="dropdown" href="#">Contato</a>
                        <div class="dropdown-menu bg-primary" aria-labelledby="ddContato">
                            <a class="dropdown-item" href="#">Quem somos</a>
                            <a class="dropdown-item" href="#">FAQ</a>
                            <a class="dropdown-item" href="#">Privacidade</a>
                        </div>
                    </li> --}}

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.contacts.create') }}">Contato</a>
                    </li>
                </ul>

                <ul class="navbar-nav  ml-md-auto  ">

                    @guest
                  
                    @else
                    <li class="nav-item">
                        <a class="nav-link py-2" href="/users/opportunity" >
                            <span style="top:12px;margin-left:-12px;" class="position-absolute badge rounded-pill bg-danger">{{$notification}}</span>
                            <i class="fa fa-bell" aria-hidden="true"></i>
                            Notificações                  
                        </a>
                    </li>
                    @endguest
                    <li role="separator" class="divider"></li>

                    <li class="nav-item">
                        <a class="nav-link py-2" href="{{ route('user.users.index') }}"><i class="fa fa-user"
                                aria-hidden="true"></i> Minha Conta</a>
                    </li>

                    <!-- Authentication Links -->
                    @guest

                    @else
                    
                    <li class="nav-item">

                        <a class="nav-link py-2" href="{{ route('user.logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"
                                aria-hidden="true"></i>
                            {{ __('Sair') }}
                        </a>

                        <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                    @endguest

                    <a class="btn btn-outline-light d-lg-inline-block mb-3 mb-md-0 ml-md-3 rounded-0"
                        href="{{ route('user.ads.create') }}">Anunciar</a>
                </ul>

            </div>

        </nav>

        <div id="app">
            @yield('container')
        </div>

        <div id="footer" class="bg-b-blue">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12">
                        <img src="{{ asset('img/horizontal_branco.png') }}" class="img-fluid w-50 mb-3" alt="">
                        {{-- <p class="text-light">{{ get_config('endereco') }}</p> --}}
                        <h4 class="title mt-4 text-light text-uppercase">Fale Conosco</h4>
                        {{-- <p class="text-light m-0">{{ get_config('telefone') }}</p> --}}
                        <p class="text-light  m-0">{{ get_config('email') }}</p>
                    </div>

                    <div class="col-lg-6 col-md-6 col-12">
                        <h4 class="title mt-4 text-b-yellow text-uppercase">Menu</h4>
                        <ul class="nav listaRodape">
                            {!! app(App\Http\Controllers\User\NavigationController::class)->getMenu(2,'footer') !!}
                        </ul>

                        <h4 class="title mt-4 text-b-yellow text-uppercase">Nos siga</h4>
                        <ul class="nav listaRodape">
                            <li><a href="https://www.facebook.com/BuscaRHweb/" title="Facebook" target="_blank"
                                    class="btn"><i class="fa  fa-2x fa-facebook" aria-hidden="true"></i></a>
                            </li>
                            <li><a href="https://www.instagram.com/BuscaRHweb" title="Instagram" target="_blank"
                                    class="btn"><i class="fa fa-2x fa-instagram" aria-hidden="true"></i></a>
                            </li>
                            <li><a href="https://www.linkedin.com/in/buscarhweb-063718197" title="Linkedin"
                                    target="_blank" class="btn"><i class="fa  fa-2x fa-linkedin"
                                        aria-hidden="true"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="row text-light small mt-2 py-2">
                    <div class="col-8">{{ get_config('site_name') }} &copy; Copyright {{ date('Y') }} Todos os
                        Direitos
                        Reservados. <a href="#" class="text-b-yellow">Política de Privacidade</a></div>
                    {{-- <div class="col-4 text-right">Desenvolvido por: </div> --}}
                </div>
            </div>
        </div>


    </div>



    <script src="{{ asset('js/app.js') }}"></script>


    {{-- <script src="{{ asset('user/js/popper.min.js') }}"></script>
    <script src="{{ asset('user/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('user/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script> --}}


    {{-- <script src="{{ asset('user/bower_components/jquery-confirm2/dist/jquery-confirm.min.js') }}"></script> --}}
    <script src="{{ asset('user/bower_components/parallax.js/parallax.min.js') }}"></script>
    <script src="{{ asset('user/bower_components/slick-carousel/slick/slick.js') }}"></script>
    <script src="{{ asset('user/bower_components/bootstrap-validator/dist/validator.min.js') }}"></script>
    <script src="{{ asset('user/bower_components/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('user/bower_components/ckeditor/ckeditor.js') }}"></script>

    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();

            $('[data-toggle="tooltip"]').tooltip()
        });
    </script>

    <script src="{{ asset('js/util.js') }}"></script>




    @stack('scripts')

    @if(env('UA_GOOGLE',config('myconfig.google_analytics_ua')))
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-153803341-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'UA-153803341-1');
    </script>
    @endif

    <!-- <script data-ad-client="ca-pub-6634788735907899" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> -->

</body>

</html>
