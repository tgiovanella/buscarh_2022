<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use PagSeguro;


class PagSeguroController extends Controller
{

    public const STATUS_WAITING = 1; // 1	Aguardando pagamento: o comprador iniciou a transação, mas até o momento o PagSeguro não recebeu nenhuma informação sobre o pagamento.
    public const STATUS_ANALYZE = 2; // 2	Em análise: o comprador optou por pagar com um cartão de crédito e o PagSeguro está analisando o risco da transação.
    public const STATUS_PAY = 3; // 3	Paga: a transação foi paga pelo comprador e o PagSeguro já recebeu uma confirmação da instituição financeira responsável pelo processamento.
    public const STATUS_AVAILABLE = 4; // 4	Disponível: a transação foi paga e chegou ao final de seu prazo de liberação sem ter sido retornada e sem que haja nenhuma disputa aberta.
    public const STATUS_IN_DISPUTE = 5; // 5	Em disputa: o comprador, dentro do prazo de liberação da transação, abriu uma disputa.
    public const STATUS_RETURNED = 6; // 6	Devolvida: o valor da transação foi devolvido para o comprador.
    public const STATUS_CANCELED = 7; // 7	Cancelada: a transação foi cancelada sem ter sido finalizada.



    public function notification(Request $request)
    {
        try {
            $notification =  PagSeguro::notification($request->notificationCode, $request->notificationType); // Ou PagSeguroRecorrente

            // return $inscription;


            return response('Atualizado com sucesso', 200);
        } catch (\Exception $x) {
            return response($x->getMessage(), 200);

            return $x->getMessage();
        }
    }
}
