<?php

namespace App\Mail;

use App\Advert;
use App\OrderPayment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailQuotation extends Mailable
{
    use Queueable, SerializesModels;

    private $applicant;
    private $rh;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($applicant,  $rh)
    {
        $this->applicant = $applicant;
        $this->rh = $rh;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Cotação Serviço - Busca RH')
            ->from(config('myconfig.email_no_reply'))
            ->view('user.emails.quotation')
            ->with([
                'applicant' => $this->applicant,
                'rh' => $this->rh
            ]);
    }
}
