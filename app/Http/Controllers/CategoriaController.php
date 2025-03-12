<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\FailedNotification;
use App\Notifications\GeneralNotification;
use App\Http\Requests\RegisterCategoryRequest;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        //

        //   if ($request->expectsJson()) {

        //     $data = Categoria::query();

        //     $data = $data->get();

        //     // Devolver los registros seleccionados
        //     return response()->json(['data' => $data]);
        // }
        // return view('categoria.index');

        if ($request->expectsJson()) {

            $data = Categoria::query();
            if ($request->categoria) {
                $data = $data->where('nombre', 'like', '%' . $request->categoria . '%');
            }

            // if ($request->categoria_id) {
            //     $data = $data->where('categoria_id', $request->categoria_id);
            // }

            $data = $data->get();

            // Devolver los registros seleccionados
            return response()->json(['data' => $data]);
        }
        $categorias = Categoria::all();
        return view('categoria.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('categoria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegisterCategoryRequest $request)
    {
        //

        // Crear un producto
       $categoria = Categoria::create($request->validated());
       $users = User::all();
    //    foreach ($users as $user) {
    //     $user->notify(new GeneralNotification(
    //         'Nueva categoria agregada',
    //         'La categoria ' . $categoria->nombre . ' '. 'ha sido agregada',
    //         url('/categoria/' . $categoria->id)
    //     ));
    // }

    foreach ($users as $user) {
        try {
            // Intentar enviar la notificación
            $user->notify(new GeneralNotification(
                'Nueva categoria agregada',
                'La categoria ' . $categoria->nombre . ' '. 'ha sido agregada',
                url('/categoria/' . $categoria->id)
            ));
        } catch (\Exception $e) {
            // Si falla el envío, guardar en la base de datos
            FailedNotification::create([
                'email' => $user->email,
                'title' =>  'Nueva categoria agregada',
                'message' => 'La categoria: ' . $categoria->nombre . ' ha sido agregada',
                'url' => url('/categorias/' . $categoria->id),
                'sent' => false
            ]);
        }
    }

        return response()->json(["message" => "Se ha creado el registro de forma exitosa"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        //
        $categoria = Categoria::find($id);
       // $categorias = Categoria::all();
        return view('categoria.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $inventario = Categoria::find($id);
        $inventario->update($request->all());
        return response()->json(["message" => "Se ha actualizado el registro de forma exitosa"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria, int $id)
    {
        //

        $categoria = Categoria::find($id);
        // Eliminar el registro seleccionado y enviar respuesta
        if ($categoria->delete()) {
            return response()->json(["message" => "Se ha eliminado el registro de forma exitosa"]);
        }
        // respuesta de error
        return response()->json(["Hubo un problema al momento de realizar la operación"], 400);
    }
}
