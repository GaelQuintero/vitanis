<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProductCreateNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $producto;

    public function __construct($producto)
    {
        $this->producto = $producto;
    }

    // Definir por qué canal se enviará la notificación (en este caso, base de datos)
    public function via($notifiable)
    {
        return ['database'];
    }

    // Formato de la notificación para almacenar en la base de datos
    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Nuevo producto creado',
            'message' => 'El producto ' . $this->producto->nombre . ' ha sido agregado al inventario.',
            'url' => url('/productos/' . $this->producto->id),
        ];
    }
}
