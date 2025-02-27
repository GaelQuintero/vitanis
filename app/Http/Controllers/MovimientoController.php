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
            $data = $data->map(function ($item) {
                // Calcular importe como precio * cantidad y agregarlo como nueva columna
                $item->fecha_movimiento = $item->created_at->format('d-m-Y');

                return $item;
            });

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
        $producto = Inventario::find($request->producto_id);
        if ($request->tipo == 'entrada') {
            $producto->cantidad_actual += $request->cantidad;
        } else {
            if ($producto->cantidad_actual < $request->cantidad) {
                return response()->json(["message" => "No se puede realizar la salida, la cantidad actual es menor a la solicitada"], 400);
            }
            $producto->cantidad_actual -= $request->cantidad;
        }
        $producto->save();
        Movimiento::create($request->validated());

        return response()->json(["message" => "Se ha creado el registro de forma exitosa"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        // Obtener los movimientos filtrados por producto con su relación de inventario
        $movimientos = Movimiento::with('producto')
            ->where('producto_id', $id)
            ->get();

        // Formatear los datos para Google Charts
        $data = [];
        foreach ($movimientos as $movimiento) {
            $data[] = [
                date('Y-m-d', strtotime($movimiento->created_at)), // Fecha como string
                $movimiento->tipo == 'entrada' ? (int) $movimiento->cantidad : 0, // Entradas
                $movimiento->tipo == 'salida' ? (int) $movimiento->cantidad : 0  // Salidas
            ];
        }
        return response()->json(['data' => $data]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        // Busca el movimiento por ID, con la relación inventario
        // $movimiento = Movimiento::with('inventario')->find($id); // Lanza 404 si no existe
        $movimiento = Movimiento::find($id);
        // Obtener todos los productos del inventario
        $productos = Inventario::all();
        //$movimientos = Movimiento::all();

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
        $producto = Inventario::find($request->producto_id);
        if ($request->tipo == 'entrada') {
            $cantidad_anterior = $movimiento->cantidad;
            $producto->cantidad_actual -= $cantidad_anterior;
            $producto->cantidad_actual += $request->cantidad;
        } else {
            if ($producto->cantidad_actual < $request->cantidad) {
                return response()->json(["message" => "No se puede realizar la salida, la cantidad actual es menor a la solicitada"], 400);
            }
            $producto->cantidad_actual -= $request->cantidad;
        }
        $producto->save();
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
