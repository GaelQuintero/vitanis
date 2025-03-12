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
        $notificaciones = Auth::user()->notifications;
        //$notificaciones = Auth::user()->unreadNotifications;

        return view('notificaciones.index', compact('notificaciones'));
    }

 
}
