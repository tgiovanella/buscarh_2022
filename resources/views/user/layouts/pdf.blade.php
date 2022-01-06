<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ __('Relatório') }}</title>



    <style>
        .clear {
            clear: both;
        }
    </style>
    <!-- styles -->
    @stack('styles')
</head>

<body>



    <div class="container">

        <div class="row" style="margin-bottom: 20px">
            <div class="col">
                <img style="float: left; padding-right: 20px" src="http://bnbinternacional.com/img/logo_150px.jpg" width="120px" >
                <h1 style="padding: 25px; text-align: right;"> @yield('title',__('general.reports'))</h1>
            </div>
        </div>
        <div class="clear" ></div>

        @yield('content')
    </div>


</body>

</html>
