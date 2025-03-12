<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class GeneralNotification extends Notification
{
    public $title;
    public $message;
    public $url;

    public function __construct($title, $message, $url)
    {
        $this->title = $title;
        $this->message = $message;
        $this->url = $url;
    }

    public function via($notifiable)
    {
        return ['database', 'mail']; // Guardar en la base de datos y enviar al correo
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject($this->title)
            ->greeting('¡Hola!')
            ->line($this->message)
            // ->action('Ver Detalles', url($this->url))
            ->line('Gracias por usar nuestra aplicación.');
    }

    public function toArray($notifiable)
    {
        return [
            'title' => $this->title,
            'message' => $this->message,
            'url' => $this->url
        ];
    }
}
