<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NuevoDerechoPeticion extends Notification
{
    use Queueable;

    protected $numeroRadicado;
    protected $fechaVencimiento;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($numeroRadicado, $fechaVencimiento)
    {
        $this->numeroRadicado = $numeroRadicado;
        $this->fechaVencimiento = $fechaVencimiento;
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
            ->subject('Nuevo derecho de petición asignado')
            ->line('Se le asignó un derecho de petición con número de radicado ' . $this->numeroRadicado . ' el cual vence el día ' . $this->fechaVencimiento);
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
