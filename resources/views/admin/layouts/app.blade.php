<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | @yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('adm/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adm/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('adm/bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adm/bower_components/admin-lte/dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('adm/bower_components/admin-lte/dist/css/skins/_all-skins.min.css') }}">


    <link rel="stylesheet"
        href="{{ asset('adm/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

    <!-- jquery confirm -->
    <link rel="stylesheet" href="{{ asset('adm/bower_components/jquery-confirm2/dist/jquery-confirm.min.css') }}">

    <link rel="stylesheet" href="{{ asset('user/bower_components/select2/dist/css/select2.min.css') }}">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->



    @stack('styles')
    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- custons -->
    <link rel="stylesheet" href="{{ asset('adm/css/custom.css') }}">
</head>

<body class="hold-transition skin-purple sidebar-mini {{--sidebar-collapse--}}">
    <!-- Site wrapper -->
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="{{ route('admin.home')  }}" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>B</b>H</span>
                <!-- logo for regular state and mobile devices -->
                {{--<span class="logo-lg"><img src="{{ asset('img/logo-white-atlantica.png') }}" class="img-responsive"
                width="70%"></span>--}}
                <span class="logo-lg"><b>Busca</b> RH</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li><a target="_blank" href="{{ route('user.home') }}"><i class="fa fa-link"></i>
                                <span>{{ __('Abrir Site') }}</span></a>
                        </li>
                        <li><a onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                href="{{ route('admin.logout') }}"><i class="fa fa-power-off"></i>
                                <span>{{ __('general.nav_exit') }}</span></a>
                        </li>

                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- =============================================== -->

        <!-- Left side column. contains the sidebar -->
        @include('admin.layouts.menu')

        <!-- =============================================== -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    @yield('title','Dashboard')
                </h1>

                {{-- @yield('breadcrumb') --}}

                @if(isset($breadcrumb))
                {!! breadcrumb($breadcrumb) !!}
                @endif

            </section>

            <!-- Main content -->
            <section class="content">
                @include('admin.layouts.message')

                @yield('content')

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 1.0.0
            </div>
            <strong>Copyright &copy; 2019-{{date('Y')}} <a href="#" target="_blank">Matheus Flauzino</a>.</strong> Todos
            os
            direitos reservados.
        </footer>


        <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery 3 -->
    <script src="{{ asset('adm/bower_components/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('adm/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('adm/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('adm/bower_components/fastclick/lib/fastclick.js') }}"></script>


    <script src="{{ asset('adm/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

    <!-- validation -->
    <script src="{{ asset('adm/bower_components/bootstrap-validator/dist/validator.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adm/bower_components/admin-lte/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('adm/bower_components/admin-lte/dist/js/demo.js') }}"></script>

    <!-- jquery confirm -->
    <script src="{{ asset('adm/bower_components/jquery-confirm2/dist/jquery-confirm.min.js') }}"></script>

    <script src="{{ asset('user/bower_components/select2/dist/js/select2.min.js') }}"></script>



    <script src="{{ asset('js/util.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('.sidebar-menu').tree()

            //Date picker
            $('.datepicker').datepicker({
                autoclose: true,
                format: 'dd/mm/yyyy',
                language: 'pt-BR',
            });



        });

        $(document).ready(function() {
            $('.js-select2').select2();
        });



    </script>

    @stack('scripts')

</body>

</html>
