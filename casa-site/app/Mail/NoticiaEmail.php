<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NoticiaEmail extends Mailable
{
    use Queueable, SerializesModels;


    protected $detalhes;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($detalhes)
    {
        $this->detalhes = $detalhes;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.unsubscribe')
                    ->subject($this->detalhes['titulo'].' - '.config('app.name'))
                    ->with('detalhes', $this->detalhes);;
    }
}
