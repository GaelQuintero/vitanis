<?php

namespace App\Http\Controllers\Auth;


use App\Models\Categoria;
use App\Models\Inventario;
use App\Models\Movimiento;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();
    
        // // Contar los productos, categorías y movimientos
        // $totalProductos = Inventario::count();
        // $totalCategorias = Categoria::count();
        // $totalMovimientosEntrada = Movimiento::where('tipo', 'entrada')->count();
        // $totalMovimientosSalida = Movimiento::where('tipo', 'salida')->count();
        
    
        // // Almacenar en la sesión
        // session([
        //     'totalProductos' => $totalProductos,
        //     'totalCategorias' => $totalCategorias,
        //     'totalMovimientosEntrada' => $totalMovimientosEntrada,
        //     'totalMovimientosSalida' => $totalMovimientosSalida,
        // ]);
    
        // Redirigir con los datos
        return redirect()->intended(route('dashboard', absolute: false));
    }
    
    

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
