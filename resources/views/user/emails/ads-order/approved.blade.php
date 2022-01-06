<!doctype html>
<html>

<head>
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Ordem de Pagamento</title>
    <style>
        /* -------------------------------------
        INLINED WITH htmlemail.io/inline
    ------------------------------------- */
        /* -------------------------------------
        RESPONSIVE AND MOBILE FRIENDLY STYLES
    ------------------------------------- */
        @media only screen and (max-width: 620px) {
            table[class=body] h1 {
                font-size: 28px !important;
                margin-bottom: 10px !important;
            }

            table[class=body] p,
            table[class=body] ul,
            table[class=body] ol,
            table[class=body] td,
            table[class=body] span,
            table[class=body] a {
                font-size: 16px !important;
            }

            table[class=body] .wrapper,
            table[class=body] .article {
                padding: 10px !important;
            }

            table[class=body] .content {
                padding: 0 !important;
            }

            table[class=body] .container {
                padding: 0 !important;
                width: 100% !important;
            }

            table[class=body] .main {
                border-left-width: 0 !important;
                border-radius: 0 !important;
                border-right-width: 0 !important;
            }

            table[class=body] .btn table {
                width: 100% !important;
            }

            table[class=body] .btn a {
                width: 100% !important;
            }

            table[class=body] .img-responsive {
                height: auto !important;
                max-width: 100% !important;
                width: auto !important;
            }
        }

        /* -------------------------------------
        PRESERVE THESE STYLES IN THE HEAD
    ------------------------------------- */
        @media all {
            .ExternalClass {
                width: 100%;
            }

            .ExternalClass,
            .ExternalClass p,
            .ExternalClass span,
            .ExternalClass font,
            .ExternalClass td,
            .ExternalClass div {
                line-height: 100%;
            }

            .apple-link a {
                color: inherit !important;
                font-family: inherit !important;
                font-size: inherit !important;
                font-weight: inherit !important;
                line-height: inherit !important;
                text-decoration: none !important;
            }

            #MessageViewBody a {
                color: inherit;
                text-decoration: none;
                font-size: inherit;
                font-family: inherit;
                font-weight: inherit;
                line-height: inherit;
            }

            .btn-primary table td:hover {
                background-color: #34495e !important;
            }

            .btn-primary a:hover {
                background-color: #34495e !important;
                border-color: #34495e !important;
            }

            .btn {
                text-decoration: none;
                padding: 15px 20px;
                margin: 10px;
                color: #fff;
                background-color: #0072bc;
                border-color: #0072bc;
            }

            a.btn:hover {
                color: #fff;
                background-color: #005b96;
                border-color: #005389;
            }

            .table-info {
                width: 100%;
                border-collapse: collapse;

            }

            .table-info tr {
                margin: 0;
                padding: 0;
            }

            .table-info td,
            .table-info th {
                border: 1px solid #cecece;
                padding: 5px 3px;
                margin: 0;
                text-align: center;
            }

            .table-info th {
                font-weight: bold;
                background: #005389;
                color: white;
            }

            .link {
                text-decoration: none;
                font-weight: bold;
                color: #6f59d4;
            }
        }
    </style>
</head>

<body class=""
    style="background-color: #f6f6f6; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
    <table border="0" cellpadding="0" cellspacing="0" class="body"
        style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background-color: #f6f6f6;">
        <tr>
            <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">

            </td>
            <td class="container"
                style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; Margin: 0 auto; max-width: 580px; padding: 10px; width: 580px;">
                <div class="content"
                    style="box-sizing: border-box; display: block; Margin: 0 auto; max-width: 580px; padding: 10px;">

                    <!-- START CENTERED WHITE CONTAINER -->
                    <span class="preheader" style="text-align: center;">
                        <h2
                            style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;">
                            Orderm de Pagamento</h2>
                        <img src="{{ asset('img/logo_rh_300.png') }}" alt=""
                            style="width: 140px; margin: 20px auto; display: block;">
                    </span>
                    <table class="main"
                        style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background: #ffffff; border-radius: 3px;">

                        <!-- START MAIN CONTENT AREA -->
                        <tr>
                            <td class="wrapper"
                                style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
                                <table border="0" cellpadding="0" cellspacing="0"
                                    style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
                                    <tr>
                                        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">

                                            <h1>Olá, {{ $name }}</h1>
                                            <p
                                                style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">
                                                O seu anúncio <strong>{{ $ads->id }}</strong>, feito dia
                                                {{ date_format($ads->created_at,'d/m/Y') }},
                                                foi
                                                aprovada pela nossa equipe e agora falta pouco para ser publicado.
                                            </p>

                                            <p style="text-align: center;">
                                                <img src="{{ asset('img/status-ads/2.png') }}" alt=""
                                                    style="width: 100%; margin: 20px auto; display: block;">
                                            </p>
                                            <p
                                                style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">
                                                Por favor, confira os dados abaixo e lembre-se de que eles devem estar
                                                corretos para que a entrega seja efetuada.
                                            </p>


                                            <p
                                                style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">
                                                <strong>Agora falta pouco!</strong> Por favor, confira os dados e
                                                realize o pagamento através do botão abaixo e o seu
                                                anúncio já será vinculado em nosso site imediatamente.
                                            </p>

                                            <table class="table-info">
                                                <tr>
                                                    <th>Plano</th>
                                                    <th>Período</th>
                                                    <th>Teste</th>
                                                    <th>Valor</th>
                                                </tr>
                                                <tr>
                                                    <td>{{ @$order->plane->name }}</td>
                                                    <td>@if($order->plane->period)
                                                        {{ __('messages.'.$order->plane->period) }}
                                                        @endif</td>
                                                    <td>{{ @$order->plane->trial_period_duration }} dias</td>
                                                    <td>{{ @$order->plane->amount_per_payment }} R$</td>
                                                </tr>
                                            </table>

                                            <p style="text-align: center; margin: 30px;">
                                                <a href="{{ route('user.checkout.create',md5($order->id) . '-' . $ads->token_id . '-' . md5(date('dmyHsi')) ) }}"
                                                    style=" " class="btn btn-primary">REALIZAR PAGAMENTO</a>
                                            </p>

                                            <p
                                                style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">
                                                <a href="#" class="link">Clique aqui</a> e acompanhe o status do seu
                                                anúncio.</p>





                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <!-- END MAIN CONTENT AREA -->
                    </table>

                    <!-- START FOOTER -->
                    <div class="footer" style="clear: both; Margin-top: 10px; text-align: center; width: 100%;">
                        <table border="0" cellpadding="0" cellspacing="0"
                            style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
                            <tr>
                                <td class="content-block"
                                    style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999; text-align: center;">
                                    <span class="apple-link"
                                        style="color: #999999; font-size: 12px; text-align: center;">Busca RH Web</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="content-block powered-by"
                                    style="font-family: sans-serif; display: none; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999; text-align: center;">
                                    Desenvolvido por <a href="#"
                                        style="color: #999999; font-size: 12px; text-align: center; text-decoration: none;">.</a>.
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!-- END FOOTER -->

                    <!-- END CENTERED WHITE CONTAINER -->
                </div>
            </td>
            <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">&nbsp;</td>
        </tr>
    </table>
</body>

</html>
