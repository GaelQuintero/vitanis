<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\FailedNotification;
use Illuminate\Support\Facades\Auth;
use App\Notifications\GeneralNotification;
use App\Http\Requests\RegisterUsersRequest;

class UserController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            // Obtener los usuarios sin relaciones inexistentes
            $data = User::query();

            // Filtro por nombre de usuario
            if ($request->name) {
                $data->where('name', 'like', '%' . $request->name . '%');
            }

            // Filtro por email
            if ($request->email) {
                $data->where('email', 'like', '%' . $request->email . '%');
            }

            // Obtener los registros filtrados
            $data = $data->get();
            $data = $data->map(function ($item) {
                // Calcular importe como precio * cantidad y agregarlo como nueva columna
                $item->fecha_registro = $item->created_at->format('d-m-Y');

                return $item;
            });


            // Responder con JSON
            return response()->json(['data' => $data]);
        }

        // Obtener todos los usuarios
        $usuarios = User::all();

        // Enviar a la vista correcta
        return view('usuarios.index', ['rol' => Auth::user()->rol], compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(RegisterUsersRequest $request)
    {
        // Crear un usuario

        $newUser = User::create($request->validated());
        $users = User::all();

        // foreach ($users as $user) {
        //     $user->notify(new GeneralNotification(
        //         'Nuevo usuario registrado',
        //         'El usuario ' . $newUser->name . ' ' . 'ha sido registrado con el correo' . ' ' . $newUser->email . ' ' . 'y fue registrado en la fecha: ' . ' ' . $newUser->created_at,
        //         url('/user/' . $newUser->id)
        //     ));
        // }

        foreach ($users as $user) {
            try {
                // Intentar enviar la notificación
                $user->notify(new GeneralNotification(
                    'Nuevo usuario registrado',
                    'El usuario ' . $newUser->name . ' ' . 'ha sido registrado con el correo' . ' ' . $newUser->email . ' ' . 'y fue registrado en la fecha: ' . ' ' . $newUser->created_at,
                    url('/user/' . $newUser->id)
                ));
            } catch (\Exception $e) {
                // Si falla el envío, guardar en la base de datos
                FailedNotification::create([
                    'email' => $user->email,
                    'title' => 'Nuevo usuario registrado',
                    'message' =>    'El usuario ' . $newUser->name . ' ' . 'ha sido registrado con el correo' . ' ' . $newUser->email . ' ' . 'y fue registrado en la fecha: ' . ' ' . $newUser->created_at,
                    'url' =>     url('/user/' . $newUser->id),
                    'sent' => false
                ]);
            }
        }


        return response()->json(["message" => "Se ha creado el registro de forma exitosa"]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        //
        $usuarios = User::find($id);
        return view('usuarios.edit', compact('usuarios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        //
        $usuarios = User::find($id);
        $usuarios->update($request->all());
        return response()->json(["message" => "Se ha actualizado el registro de forma exitosa"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $usuario)
    {
        //
        // Eliminar el registro seleccionado y enviar respuesta
        if ($usuario->delete()) {
            return response()->json(["message" => "Se ha eliminado el registro de forma exitosa"]);
        }
        // respuesta de error
        return response()->json(["Hubo un problema al momento de realizar la operación"], 400);
    }
}
