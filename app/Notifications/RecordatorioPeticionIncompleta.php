<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Peticion;

class RecordatorioPeticionIncompleta extends Notification
{
    use Queueable;

    protected $peticion;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Peticion $peticion)
    {
        $this->peticion = $peticion;
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
            ->subject('Recordatorio: Petición Incompleta')
            ->line($notifiable->name . ',')
            ->line('Esta es una notificación para recordarte que tienes una petición pendiente con el número de radicado ' . $this->peticion->numero_radicado . '.')
            ->line('La cual tiene ' . $this->peticion->dias . ' dias para vencerse.')
            ->line('Por favor, completa esta petición lo antes posible.')
            ->line('¡Gracias por tu atención!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
