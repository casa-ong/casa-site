<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Sugestao;

class NovaSugestaoNotification extends Notification
{
    use Queueable;

    // protected $user;
    protected $sugestao;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Sugestao $sugestao)
    {
        // $this->user = $user;
        $this->sugestao = $sugestao;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->from($this->sugestao->email, 'Centro de Apoio Social e Ambiental')
                    ->greeting('Olá!')
                    ->subject('Nova sugestão recebida')
                    ->line('Acabamos de receber uma nova sugestão no site, acesse o link abaixo para conferir.')
                    ->action('Ver sugestão', url('/admin/sugestao/ver/'.$this->sugestao->id));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
