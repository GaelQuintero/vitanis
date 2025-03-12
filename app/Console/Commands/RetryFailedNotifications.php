<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\FailedNotification;
use App\Models\User;
use App\Notifications\GeneralNotification;
use Illuminate\Support\Facades\Log;

class RetryFailedNotifications extends Command
{
    protected $signature = 'notifications:retry';
    protected $description = 'Reintenta enviar notificaciones fallidas cuando haya conexión a internet.';

    public function handle()
    {
        Log::info('Iniciando comando notifications:retry');

        // Verificar conexión a internet
        if (!$this->isConnectedToInternet()) {
            Log::info('No hay conexión a internet. El comando no se ejecutará.');
            $this->error('No hay conexión a internet.');
            return;
        }

        // Obtener notificaciones fallidas
        $failedNotifications = FailedNotification::where('sent', false)->get();

        if ($failedNotifications->isEmpty()) {
            Log::info('No hay notificaciones fallidas para reenviar.');
            $this->info('No hay notificaciones fallidas para reenviar.');
            return;
        }

        foreach ($failedNotifications as $notification) {
            Log::info("Procesando notificación para: {$notification->email}");

            try {
                // Buscar usuario por email
                $user = User::where('email', $notification->email)->first();

                if ($user) {
                    // Enviar la notificación
                    $user->notify(new GeneralNotification(
                        $notification->title,
                        $notification->message,
                        $notification->url
                    ));

                    // Marcar como enviada
                    $notification->update(['sent' => true]);

                    Log::info("Correo reenviado a: {$notification->email}");
                    $this->info("Correo reenviado a: {$notification->email}");
                } else {
                    Log::error("Usuario con email {$notification->email} no encontrado.");
                    $this->error("Usuario con email {$notification->email} no encontrado.");
                }
            } catch (\Exception $e) {
                Log::error("Error al reenviar correo a {$notification->email}: " . $e->getMessage());
                $this->error("Error al reenviar correo a {$notification->email}: " . $e->getMessage());
            }
        }

        Log::info('Comando notifications:retry completado.');
        $this->info('Proceso de reintento completado.');
    }

    // Método para verificar la conexión a internet
    private function isConnectedToInternet()
    {
        $connected = @fsockopen('www.google.com', 80); // Intenta conectarse a Google
        if ($connected) {
            fclose($connected);
            return true;
        }
        return false;
    }
}
