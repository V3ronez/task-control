<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;
    protected $token;
    protected $email;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token, $email)
    {
        $this->token = $token;
        $this->email = $email;
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
        $minutes = config('auth.passwords.' . config('auth.defaults.passwords') . '.expire');
        $url = 'http://localhost:8000/password/reset/' . $this->token . '?email=' . $this->email;
        return (new MailMessage)
            ->subject('Redefinir senha')
            // ->greeting( saudacao $this->name)
            ->line('Se voce quer redefinir sua senha, clique no link abaixo')
            // ->salutation(até breve)
            ->action('Nova senha', $url)
            ->line('O link se expira em ' . $minutes . ' minutos')
            ->line('se voce não quer redefinir a senha, não precisa fazer nada.');

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
