<?php


namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\Categoria;
use App\Models\Movimiento;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Obtener los conteos
        $totalProductos = Inventario::count();
        $totalCategorias = Categoria::count();
        $totalMovimientos = Movimiento::count();
        $totalMovimientosEntrada = Movimiento::where('tipo', 'entrada')->count();
        $totalMovimientosSalida = Movimiento::where('tipo', 'salida')->count();

        // Obtener los últimos 5 registros
        $ultimosMovimientos = Movimiento::latest()->take(5)->get();

        // Pasar los datos a la vista
        return view('dashboard', compact(
            'totalProductos',
            'totalCategorias',
            'totalMovimientos',
            'totalMovimientosEntrada',
            'totalMovimientosSalida',
            'ultimosMovimientos'
        ));
    }
}
