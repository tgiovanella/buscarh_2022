<?php



/**
 * Get either a Gravatar URL or complete image tag for a specified email address.
 *
 * @param string $email The email address
 * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
 * @param string $d Default imageset to use [ 404 | mp | identicon | monsterid | wavatar ]
 * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
 * @param boole $img True to return a complete IMG tag False for just the URL
 * @param array $atts Optional, additional key/value attributes to include in the IMG tag
 * @return String containing either just a URL or a complete image tag
 * @source https://gravatar.com/site/implement/images/php/
 */
function get_gravatar( $email, $s = 80, $d = 'mp', $r = 'g', $img = false, $atts = array() ) {
    $url = 'https://www.gravatar.com/avatar/';
    $url .= md5( strtolower( trim( $email ) ) );
    $url .= "?s=$s&d=$d&r=$r";
    if ( $img ) {
        $url = '<img src="' . $url . '"';
        foreach ( $atts as $key => $val )
            $url .= ' ' . $key . '="' . $val . '"';
        $url .= ' class="img-circle" alt="User Image" />';
    }
    return $url;
}


function breadcrumb($routes) {
    $html = '';
    $html .= '<ol class="breadcrumb">';
    $html .= '<li><a href="' . route('admin.home') . '"><i class="fa fa-dashboard"></i> Home</a></li>';
    foreach($routes as $key => $value) {
        if($key === 'end')
            $html .= '<li class="active">' . $value . '</li>';
        else
            $html .= '<li><a href="' . route($key) . '">' .  $value . '</a></li>';
    }


    $html .= '</ol>';


    return $html;
}


function info_pages($results) {
   return "Visualisando do registro ". $results->firstItem() . " ao " . $results->lastItem() . " de ". $results->total() .".";
}


function labels($label,$lang,$colors) {
    return '<span class="label '. config($colors.'.'.$label) . '">' . __($lang.'.'.$label) . '</span>';
}



//  const STATUS_PENDING = 1; //PENDENTE
//     const STATUS_APPROVED = 2; //APROVADO PELA EQUIPE DO BUSCA WEB RH
//     const STATUS_WAIT_PAYMENT = 3; //AGUARDANDO PAGAMENTO
//     const STATUS_ANNOUNCED = 4; //ANUNCIADO //pAGAMENTO OK
//     const STATUS_CANCELED = 5; //CANCELADO/RECUSADO PAGAMENTO
//     const STATUS_LOSER = 6; //VENCIDO

function labels_status_ads($label) {

    switch ($label) {
        case App\Advert::STATUS_PENDING:
            return '<span class="label label-warning">Pendente</span>';
            break;
        case App\Advert::STATUS_APPROVED:
            return '<span class="label label-info">Faturado/Aguardando Pagamento</span>';
            break;
        case App\Advert::STATUS_ANNOUNCED:
            return '<span class="label label-success">Anunciado</span>';
            break;
        case App\Advert::STATUS_CANCELED:
            return '<span class="label label-danger">Cancelado/Recusado Pagamento</span>';
            break;

        default:

            break;
    }

    return '<span class="label label-danger">' . $label .'</span>';
}

function convertDate( $date , $opcao = null)
{
    $V_data = $date;

    if (strstr(substr(trim($date), 0, 10), "/") && $opcao <> '/')
    {
        $A = explode("/", substr(trim($date), 0, 10));
        $V_data = $A[2] . "-" . $A[1] . "-" . $A[0];
    }

    if (strstr(substr(trim($date), 0, 10), "-") && $opcao <> '-')
    {
        $A = explode("-", substr(trim($date), 0, 10));
        $V_data = $A[2] . "/" . $A[1] . "/" . $A[0];
    }
    return $V_data;
}


function convertDateTimeUS2BR($date) {
    return date('d/m/Y H:i', strtotime($date));
}


function array_combo($array,$id = null)
{
    $html = '';


    foreach ($array as $key => $value)
    {
        $selected = ($key == $id) ? "selected" : "";
        $html .= '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
    }

    return $html;
}


function status($status) {
    if($status == true) {
        return '<i class="fa fa-circle text-green" aria-hidden="true" title="Ativo"></i>';
    }

    return '<i class="fa fa-circle text-red" aria-hidden="true" title="Invativo"></i>';

}



function get_config($name) {
    $config = App\Configuration::where('name',$name)->first();
    if($config) {
        return $config->value;
    } else {
        return 'Configuração \''. $name . '\' não definida.';
    }
}


//monta rota de mais detalhes
function get_route_detail_company($company) {


    if($company->city_id) { //se existir cidade cadastrado
        $city = Str::slug($company->city->title . '-' . $company->city->state->letter);
    } else {
        $city = 'all'; //se não existir, coloca um termo generico para ser usado no WHERE
    }

    if(!$company->slug) {
        return route('user.company.show',['slug'=> $company->slug,'city' => $city ]);
    }


    // return $company->id;
    return route('user.company.show',['slug'=> $company->slug,'city' => $city ]);
}


function create_slug_company($name, $cpf_cnpj, $id) {
    // //prepara o slug

    if($cpf_cnpj) {
        $secound = str_replace('.', '',str_replace('-', '', $cpf_cnpj)); //se existir cnpj
    } else { //se não existir cnpj, usa o id
        $secound = $id;
    }

    $slug = Str::slug($name . '-' . $secound); //retorna algo como nome-da-empresa-cnpj

    return $slug;
}



/**
 * @param $user
 * @return bool
 * Verifica se os dados do usuário estão completos
 */
function is_complete_data_user($user) {



    $not_complete = !$user->name
            || !$user->email
            || !$user->phone
            || !$user->cpf
            || !$user->birth
            || !$user->street
            || !$user->number
            || !$user->destrict
            || !$user->cep
            || !$user->city_id;

    if($not_complete) {
        \request()->session()->flash('warning',__('messages.complete_data_user',['user' => $user->name]));

        return false;
    } else {
        return true;
    }
}
