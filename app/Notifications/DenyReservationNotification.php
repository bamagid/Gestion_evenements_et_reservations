<?php

namespace App\Notifications;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DenyReservationNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct($id)
    {
       return $this->id=$id;
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
        $reservation=Reservation::findOrFail($this->id);
        $evenement=$reservation->evenement->libelle;
        $client=$reservation->client->Nom;

        return (new MailMessage)
                    ->line("Bonjour $client  votre reservation pour l'evenement  $evenement a été annulé par son organisateur")
                    ->action('Voir mes reservation sur la plateforme', url('/mesReservation'))
                    ->line('Merci pour votre fidelité ,si vous souhaité reservé pour d\'autres evenements rendez vous sur la plateforme');
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
