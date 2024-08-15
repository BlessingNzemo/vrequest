<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MailCharroiToAgentDemandeRejecte extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected $data)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->from(env('MAIL_FROM_ADDRESS'),env('APP_NAME'))
                    ->subject($this->data->subject)
                    ->greeting('cher '.$this->data->name)
                    ->line('Demande n° '.$this->data->id)
                    ->line('Votre demande a été '.$this->data->etat)
                    ->line('Motif de rejet : '.$this->data->raison)
                    ->action('Voir plus', route('demandes.show',$this->data->id))
                    ->line('Merci d\'utiliser '.env('APP_NAME'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
