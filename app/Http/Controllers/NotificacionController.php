<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificacionController extends Controller
{
    public function index(Request $request)
    {

        if ($request->expectsJson()) {

            $data = Auth::user()->notifications;

            return response()->json($data);
        }

        // Obtener todas las notificaciones del usuario autenticado
        $notificaciones = Auth::user()->unreadNotifications;

        //Limpiar notificaciones
        Auth::user()->unreadNotifications->markAsRead();

        return view('notificaciones.index', compact('notificaciones'));
    }

    public function checkNotifications()
    {
        $notifications = Auth::user()->notifications()
            ->whereNull('read_at') // Filtra solo las no leídas
            ->count();

        return response()->json(['unread_count' => $notifications]);
    }
}
