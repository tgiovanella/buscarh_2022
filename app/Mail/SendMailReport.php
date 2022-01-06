<?php

namespace App\Mail;

use App\Company;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailReport extends Mailable
{
    use Queueable, SerializesModels;

    private $company;
    private $token;
    private $name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Company $company, $dados)
    {
        $this->company = $company;
        $this->token = $dados['token'];
        $this->name = $dados['name'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Sitema de Denúncias - Busca RH')
            ->from(config('myconfig.email_no_reply'))
            ->view('user.emails.report-confirm')
            ->with([
                'token' => $this->token,
                'company' => $this->company,
                'name' => $this->name
            ]);
    }
}
