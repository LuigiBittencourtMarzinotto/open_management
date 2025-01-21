<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Crypt;

class MensagemForgettenPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    private String $_email;
    private String $_idUser;

    /**
     * Create a new message instance.
     */
    public function __construct($email, $idUser)
    {
        $this->_email = $email;
        $this->_idUser = $idUser;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Open Your Finance - Atualização de senha',
        );
    }


    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.mensagem-forgetten-password',
            with: [
                'email' =>  $this->_email,
                'link' => route('reset-password', ['id' => Crypt::encrypt($this->_idUser)]),
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
