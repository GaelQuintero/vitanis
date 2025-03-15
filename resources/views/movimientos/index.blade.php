@extends('templates.base')

@section('titulo', env('APP_NAME') . ' - Inventario')
@extends('templates.nav')
@section('body')
    <div class=" container p-4 animate__animated animate__fadeIn" data-bs-theme="dark">
        <div class="row">
            <div class="col-md-12 mb-3 text-end">
                <a class="btn btn-primary rounded-3" href="{{route('dashboard')}}">Volver</a>
            </div>
            <div class="col-md-12 mb-3 ">
                <h4>Movimientos</h4>
            </div>
            <form class="row" id="filterForm">
                <div class="col-md-4 mb-3">
                    <label class="form-label filtro-label">Tipo de movimiento</label>
                    <select class="form-control" id="tipo">
                        <option value="" selected>Seleccione una categoria</option>
                        <option value="entrada" >Entrada</option>
                        <option value="salida" >Salida</option>
                 </select>
                </div>
            </form>
            <div class="col-md-12 mb-3 text-end">
                <button class="btn me-2 btn-primary" id="buscarBtn">Buscar</button>
                <button class="btn me-2 btn-primary" id="limpiarBtn">Limpiar </button>
                <button class="btn btn-primary" id="nuevoBtn">Nuevo </button>
            </div>
            <div class="col-md-12 mb-3">
                <table class="table " id="tableMovimientos" data-bs-theme="dark">
                    <thead class="table table-dark" >
                        <tr>
                            <th scope="col">Producto</th>
                            <th scope="col">Tipo movimiento</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Fecha movimiento</th>
                            <th scope="col" width="15%"></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <script src="{{ asset('js/movimientos.js') }}" defer></script>
@endpush
