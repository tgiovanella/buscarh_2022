<?php

/**
 * Created by PhpStorm.
 * User: matheus
 * Date: 31/12/18
 * Time: 11:02
 */

return [

    'status_contact' => [
        1 => 'Não Visualizado',
        2 => 'Visualizado'
    ],

    'tag_report_companies' => [
        App\Report::TAG_FALSE_DATA => 'Dados Falso',
        App\Report::TAG_COMPANY_NOT_EXIST => 'Empresa não existe',
        App\Report::TAG_DATA_FROM_ANOTHER_PERSON => 'Uso de dados de propriedades de outras pessoas',
        App\Report::TAG_INAPPROPRIATE_CONTENT => 'Conteúdo enganoso',
        App\Report::TAG_MISLEADING_CONTENT => 'Conteúdo impróprio',
        App\Report::TAG_OTHERS => 'Outros',
    ],

    'nav_exit' => 'Sair',

    'select_options' => '-- selecione uma opção --',
    'msg_not_register' => 'Não existem registros cadastrados.',



    //formulários
    'description' => 'Descrição',
    'description_place' => 'Insira a descrição',
    'subcategories' => 'Subcategoria',
    'subcategories_place' => 'Insira a subcategoria',

    'title' => 'Título',
    'body' => 'Conteúdo',


    //mensagem
    'msg_success' => 'Registro :id salvo com sucesso.',
    'msg_error' => 'Ocorreu algum problema ao salvar o registro. Tente novamente mais tarde.',
    'msg_error_exception' => 'Ocorreu algum erro ao salvar: :exception.',

    'msg_success_delete' => 'Registro :id deletado com sucesso.',
    'msg_error_delete' => 'Ocorreu algum problema ao deletar o registro. Tente novamente mais tarde.',
    'msg_error_exception_delete' => 'Ocorreu algum erro ao salvar: :exception.',

    'msg_alert_fk' => 'Verifique se o registro já não está sendo utilizado em outro cadastro',

    //mensagem do denuncia
    'msg_success_reports' => 'A solicitação de denúncia foi realizada. Para concluir, verifique a caixa de entrada do seu email e confirme o mesmo para analisarmos.',


    'msg_contact_success' => 'A sua mensagem foi enviada com sucesso. Em breve entraremos em contato.',



    //empresa
    'name' => 'Nome',
    'fantasy' => 'Nome Fantasia',
    'cpf_cnpj' => 'CPF/CNPJ',
    'site' => 'Site',
    'cep' => 'CEP',
    'phone' => 'Telefone',
    'uf' => 'UF',
    'address' => 'Endereço',
    'number' => 'Número',
    'district' => 'Bairro',
    'complement' => 'Complemento',
    'email' => 'Email',
    'responsible' => 'Responsável',
    'owner_id' => 'Dono',
    'city_id' => 'Cidade',
    'categories' => 'Categoria',


    //tradução dos planos
    'planes' => ['MONTHLY' => 'Mensal', 'WEEKLY' => 'Semanal', 'BIMONTHLY' => 'Bimestral', 'TRIMONTHLY' => 'Trimestral', 'SEMIANNUALLY' => 'Semestral', 'YEARLY' => 'Anual']




];
