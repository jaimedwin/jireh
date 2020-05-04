<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProcessNotification extends Mailable
{
    use Queueable, SerializesModels;

    private $proceso_numero;
    private $url;
    private $codigo_proceso;
    private $codigo_cliente;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($proceso_numero, $url, $proceso_codigo, $personanatural_codigo, $subject)
    {
        $this->proceso_numero = $proceso_numero;
        $this->url = $url;
        $this->proceso_codigo = $proceso_codigo;
        $this->personanatural_codigo = $personanatural_codigo;
        $this->subject($subject);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $proceso_numero = $this->proceso_numero;
        $url = $this->url;
        $proceso_codigo = $this->proceso_codigo;
        $personanatural_codigo = $this->personanatural_codigo;
        return $this->view('sendmail.actuaciones', compact('proceso_numero', 'url', 'proceso_codigo', 'personanatural_codigo'));
    }
}
