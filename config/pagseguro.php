<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Sandbox
    |--------------------------------------------------------------------------
    |
    | Checa se utilizará o Sandbox ou Production.
    |
    */
    'sandbox' => env('PAGSEGURO_SANDBOX', false),

    /*
    |--------------------------------------------------------------------------
    | Email
    |--------------------------------------------------------------------------
    |
    | Conta de email do Vendedor.
    |
    */
    'email' => env('PAGSEGURO_EMAIL', 'marcelodpn@gmail.com'),

    /*
    |--------------------------------------------------------------------------
    | Token
    |--------------------------------------------------------------------------
    |
    | Token do Vendedor.
    |
    */
    // 'token' => env('PAGSEGURO_TOKEN', '02A10C639494F9F114C4FFA927AC82CB'),
    'token' => env('PAGSEGURO_TOKEN', '155c0830-3178-4fcf-ac7f-f0ba7ee7d58dfd8228294a11bf255119f80593f53868c61e-e474-4f92-8ebd-a2aeffd5fb38'),
    //155c0830-3178-4fcf-ac7f-f0ba7ee7d58dfd8228294a11bf255119f80593f53868c61e-e474-4f92-8ebd-a2aeffd5fb38

    /*
    |--------------------------------------------------------------------------
    | NotificationURL
    |--------------------------------------------------------------------------
    |
    | URL de resposta para notificações do Pagseguro.
    |
    */
    'notificationURL' => env('PAGSEGURO_NOTIFICATION', 'https://buscarhweb.com.br/api/pagseguro/notification'),

];
