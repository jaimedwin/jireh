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
    private $proceso_codigo;
    private $personanatural_nombrecompleto;
    private $personanatural_codigo;
    private $personanatural_fechaexpedicion;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($proceso_numero, $url, $proceso_codigo, $personanatural_nombrecompleto, $personanatural_codigo, $personanatural_fechaexpedicion, $subject)
    {

        $this->proceso_numero = $proceso_numero;
        $this->url = $url;
        $this->proceso_codigo = $proceso_codigo;
        $this->personanatural_nombrecompleto = $personanatural_nombrecompleto;
        $this->personanatural_codigo = $personanatural_codigo;
        $this->personanatural_fechaexpedicion = $personanatural_fechaexpedicion;
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
        $personanatural_nombrecompleto = $this->personanatural_nombrecompleto;
        $personanatural_codigo = $this->personanatural_codigo;
        $personanatural_fechaexpedicion = $this->personanatural_fechaexpedicion;
        return $this->view('sendmail.actuaciones', compact('proceso_numero', 'url', 'proceso_codigo', 'personanatural_nombrecompleto', 'personanatural_codigo', 'personanatural_fechaexpedicion'));
    }
}
