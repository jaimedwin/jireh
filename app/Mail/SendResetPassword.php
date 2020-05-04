<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    private $url;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($url, $subject)
    {
        $this->url = $url;
        $this->subject($subject);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $url = $this->url;
        return $this->view('sendmail.reset_password', compact('url'));
    }
}
