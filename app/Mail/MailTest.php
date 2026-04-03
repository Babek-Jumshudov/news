<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use App\Models\User;


class MailTest extends Mailable
{
    use Queueable, SerializesModels;

    private $data = [];

    public function __construct($data)
    {
        $this->data = $data;
    }

    public $view = 'Mail.sendEmail';

    public function build()
    {
        return $this->from(User::first()->email, 'Babek Cumsudov')
            ->subject($this->data['subject'])
            ->view('Mail.sendEmail')->with('data', $this->data);
    }

  
    public function content(): Content
    {
        return new Content(
            view: 'Mail.sendEmail',
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

