<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Newsletter;

class NewsletterAdicionadaNotification extends Notification
{
    use Queueable;

    // protected $user;
    protected $newsletter;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Newsletter $newsletter)
    {
        // $this->user = $user;
        $this->newsletter = $newsletter;
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
                    ->subject('Agora você será sempre informado(a)')
                    ->greeting('Olá!')
                    ->line('Você acabou de ativar as notificações de email para receber novidades.')
                    ->line('Caso não deseje receber mais notificações é só clicar no link abaixo e cancelar.')
                    ->action('Gerenciar notificações', route('newsletter.editar', [$this->newsletter->id, $this->newsletter->token]));
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