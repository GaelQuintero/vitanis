@extends('templates.base')

@section('title', 'Home')
@extends('templates.nav')
@section('body')
    {{-- <div class="container py-5">
        <div class="row">
            <div class="col-12">

                <p class="fs-1">Bienvenido  {{ Auth::user()->name }} </p>


            </div>
        </div>
    </div> --}}

    <div class="container py-4 animate__animated animate__fadeIn">

        <h2 class="mb-4">Bienvenido <span class="text-primary">{{ Auth::user()->name }}</span> 🎉</h2>

        <!-- Tarjetas de resumen -->
        <div class="row">
            <div class="col-md-3 mb-3">
                <div class="card text-bg-primary shadow-lg">
                    <div class="card-body">
                        <h5 class="card-title">Total Productos</h5>
                        <p class="card-text fs-4">{{ $totalProductos }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card text-bg-success shadow-lg">
                    <div class="card-body">
                        <h5 class="card-title">Total de categorias</h5>
                        <p class="card-text fs-4">{{ $totalCategorias }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card text-bg-warning shadow-lg">
                    <div class="card-body">
                        <h5 class="card-title">Movimientos de entrada</h5>
                        <p class="card-text fs-4">{{ $totalMovimientosEntrada }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card text-bg-danger shadow-lg">
                    <div class="card-body">
                        <h5 class="card-title">Movimientos de salida</h5>
                        <p class="card-text fs-4">{{ $totalMovimientosSalida }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de órdenes recientes -->
        <div class="card mt-4">
            <div class="card-header bg-dark text-white">Movimientos recientes</div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                           
                            <th>Tipo</th>
                            <th>Descripción</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ultimosMovimientos as $movimiento)
                            <tr>
                              
                                <td>
                                    @if ($movimiento->tipo === 'entrada')
                                        <span class="badge text-bg-primary">{{ ucfirst($movimiento->tipo) }}</span>
                                    @else
                                    <span class="badge text-bg-danger">{{ ucfirst($movimiento->tipo) }}</span>
                                    @endif
                                </td>
                                <td>{{ $movimiento->descripcion ?? 'Sin descripción' }}</td>
                                <td>{{ $movimiento->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/dashboard.js') }}" defer></script>
@endpush
