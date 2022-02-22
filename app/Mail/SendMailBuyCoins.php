<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailBuyCoins extends Mailable
{
    use Queueable, SerializesModels;
    private $applicant;
    private $company;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email,  $company, $candidateBuyCoins)
    {
        $this->applicant = $email;
        $this->company = $company;
        $this->info = $candidateBuyCoins;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Solicitação de compra Web Moedas - Busca RH Web')
            ->from(config('myconfig.email_no_reply'))
            ->view('user.emails.buyCoins')
            ->with([
                'applicant' => $this->applicant,
                'company'   => $this->company,
                'info'=> $this->info
            ]);
    }
}
