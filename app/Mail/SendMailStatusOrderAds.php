<?php

namespace App\Mail;

use App\Advert;
use App\OrderPayment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailStatusOrderAds extends Mailable
{
    use Queueable, SerializesModels;

    private $status;
    private $name;
    private $order;
    private $ads;

    const REALIZED = 1;
    const PAYMENT = 2;
    const APPROVED = 3;
    const ANNOUNCED = 4;
    // [
    //     1 => 'realized', //anuncio realizado
    //     2 => 'payment', //para pagamento
    //     3 => 'approved', //aprovado pagamento
    //     4 => 'announced' //anunciado
    // ];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($status, $name, Advert $ads, OrderPayment $order = null)
    {
        $this->status = $status;
        $this->ads = $ads;
        $this->order = $order;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        switch ($this->status) {
            case Advert::STATUS_PENDING:
                return $this->mailRealized();
                break;

            case Advert::STATUS_APPROVED:
                return $this->mailApproved();
                break;


            default:
                # code...
                break;
        }
    }

    /**
     * email para quando o anúncio for criado
     */
    private function mailRealized()
    {
        return $this
            ->subject('Anúncio Realizado - Busca RH')
            ->from(config('myconfig.email_no_reply'))
            ->view('user.emails.ads-order.realized')
            ->with([
                'name' => $this->name,
                'ads' => $this->ads
            ]);
    }

    /**
     * email para enviar o link de pagamento para o usuário e que foi aprovado o seu anúncio
     */
    private function mailApproved()
    {
        return $this
            ->subject('Anúncio Aprovado - Busca RH')
            ->from(config('myconfig.email_no_reply'))
            ->view('user.emails.ads-order.approved')
            ->with([
                'name' => $this->name,
                'ads' => $this->ads,
                'order' => $this->order

            ]);
    }
}
