<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterMovementRequest;
use App\Models\Inventario;
use App\Models\Movimiento;
use Illuminate\Http\Request;

class MovimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //

        if ($request->expectsJson()) {

            $data = Movimiento::with('producto');
            if ($request->tipo) {
                $data = $data->where('tipo', $request->tipo);
            }

            // if ($request->codigo) {
            //     $data = $data->where('codigo', $request->codigo);
            // }


            // if ($request->categoria_id) {
            //     $data = $data->where('categoria_id', $request->categoria_id);
            // }

            $data = $data->get();

            // Devolver los registros seleccionados
            return response()->json(['data' => $data]);
        }
        //$categorias = Categoria::all();
        return view('movimientos.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $productos = Inventario::all();
        return view('movimientos.create', compact('productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegisterMovementRequest $request)
    {
        //
         // Crear un producto
         Movimiento::create($request->validated());

         return response()->json(["message" => "Se ha creado el registro de forma exitosa"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Movimiento $movimiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        // Buscar el movimiento por ID, con la relación inventario
    $movimiento = Movimiento::with('inventario')->find($id); // Lanza 404 si no existe
    
    // Obtener todos los productos del inventario
    $productos = Inventario::all();
    $movimientos = Movimiento::all();

    // Enviar variables a la vista
    return view('movimientos.edit', compact('movimiento', 'productos')); // Se usa "movimiento" en singular
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        //
        $movimiento = Movimiento::find($id);
        $movimiento->update($request->all());
        return response()->json(["message" => "Se ha actualizado el registro de forma exitosa"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movimiento $movimiento)
    {
        //
         //
        // Eliminar el registro seleccionado y enviar respuesta
        if ($movimiento->delete()) {
            return response()->json(["message" => "Se ha eliminado el registro de forma exitosa"]);
        }
        // respuesta de error
        return response()->json(["Hubo un problema al momento de realizar la operación"], 400);
    }
}
