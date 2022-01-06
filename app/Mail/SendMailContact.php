<?php

namespace App\Mail;

use App\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailContact extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $subject;
    public $email;
    public $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Contact $contact)
    {
        $this->name = $contact->name;
        $this->subject = $contact->subject;
        $this->email = $contact->email;
        $this->message = $contact->message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this
            ->subject('Formulário de Contato - Busca RH')
            ->from($this->email)
            ->view('user.emails.contact')
            ->with([
                'name' => $this->name,
                'subject' => $this->subject,
                'email' => $this->email,
                'texto' => $this->message
            ]);
    }
}
