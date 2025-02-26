<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Inventario;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterProductRequest;

class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //

        if ($request->expectsJson()) {

            $data = Inventario::with('categoria');
            if ($request->producto) {
                $data = $data->where('nombre', 'like', '%' . $request->producto . '%');
            }

            if ($request->codigo) {
                $data = $data->where('codigo', $request->codigo);
            }

            
            if ($request->categoria_id) {
                $data = $data->where('categoria_id', $request->categoria_id);
            }

            $data = $data->get();

            // Devolver los registros seleccionados
            return response()->json(['data' => $data]);
        }
        $categorias = Categoria::all();
        return view('inventario.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categorias = Categoria::all();
        return view('inventario.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegisterProductRequest $request)
    {
        //
        // Crear un producto
        Inventario::create($request->validated());

        return response()->json(["message" => "Se ha creado el registro de forma exitosa"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventario $inventario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        //
        $inventario = Inventario::with('categoria')->find($id);
        $categorias = Categoria::all();
        return view('inventario.edit', compact('inventario', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        //
        $inventario = Inventario::find($id);
        $inventario->update($request->all());
        return response()->json(["message" => "Se ha actualizado el registro de forma exitosa"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventario $inventario)
    {
        //
        // Eliminar el registro seleccionado y enviar respuesta
        if ($inventario->delete()) {
            return response()->json(["message" => "Se ha eliminado el registro de forma exitosa"]);
        }
        // respuesta de error
        return response()->json(["Hubo un problema al momento de realizar la operación"], 400);
    }
}
