<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Paginação padrão do site
    |--------------------------------------------------------------------------
    |
    */
    'paginate' => 15,


    'colors_status' => [
        1 => 'bg-yellow',
        2 => 'bg-green',
    ],

    'colors_status_reports' => [
        1 => 'bg-yellow',
        2 => 'bg-green',
        3 => 'bg-red'
    ],


    'execptions' => [
        'existing_record' => '23000',
    ],

    'type_ads' => [
        1 => 'Slide com logo',
        2 => 'Nuvem de logo',
        3 => 'Banners full por categoria',
        4 => 'Banner a direita',
        5 => 'Empresa em destaque'
    ],

    'img_type_ads' => [
        1 => 'img/type-adverts/banner.png',
        2 => 'img/type-adverts/cloud.png',
        3 => 'img/type-adverts/full.png',
        4 => 'img/type-adverts/sidebar.png',
        5 => 'img/type-adverts/destaque.png',

    ],

    'position_ads' => [
        1 => 'top',
        2 => 'left',
        3 => 'right ',
        4 => 'bottom'
    ],

    'status_ads' => [

        //STATUS
        1 => 'Pendente', //STATUS_PENDING = 1;
        2 => 'Aprovado', //STATUS_APPROVED = 2;
        3 => 'Cancelado', //STATUS_CANCELED = 3;
        4 => 'Vencido', //STATUS_LOSER = 4;
    ],

    'yes_no' => [
        1 => 'Sim',
        0 => 'Não'

    ],

    'google_analytics_ua' => 'UA-153803341-1',

    'email_no_reply' => 'no-reply@buscarhweb.com.br'

];
