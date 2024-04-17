<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use Carbon\Carbon;

class CambioCorreoElectronico extends Notification
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
        $fechaVencimientoFormateada = Carbon::parse($this->fechaVencimiento)->format('d/m/Y');

        return (new MailMessage)
            ->subject('Nuevo Derecho de Petición Asignado ' . $this->numeroRadicado)
            ->line('Se le asignó un derecho de petición con número de radicado ' . $this->numeroRadicado . ' el cual vence el día ' . $fechaVencimientoFormateada)
            ->line('Este derecho de petición es una reasignación');
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
