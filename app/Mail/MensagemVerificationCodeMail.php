<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MensagemVerificationCodeMail extends Mailable
{
    use Queueable, SerializesModels;
    
    private String $_nomeUser;
    private String $_code;

    /**
     * Create a new message instance.
     */
    public function __construct($userName, $codigo)
    {
        $this->_nomeUser = $userName;
        $this->_code = $codigo;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Open Your Finance - Criamos a sua conta ' . $this->_nomeUser,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.mensagem-verification-code-email',
            with: [
                'name' =>  $this->_nomeUser,
                'code' => $this->_code,
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
