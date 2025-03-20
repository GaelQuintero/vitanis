@extends('templates.base')

@section('title', env('APP_NAME') . ' Inventario')
@extends('templates.nav')
@section('body')
    <div class=" container p-4 animate__animated animate__fadeIn" data-bs-theme="dark">
        <div class="row">
            <div class="col-md-12 mb-3 text-end">
                <a class="btn btn-primary rounded-3" href="{{route('dashboard')}}">Volver</a>
            </div>
            <div class="col-md-12 mb-3 ">
                <h4>Inventario</h4>
            </div>
            <form class="row" id="filterForm">
                <div class="col-md-4 mb-3">
                    <label class="form-label filtro-label">Producto</label>
                    <input type="text" class="form-control" id="producto" >
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label filtro-label">Codigo</label>
                    <input type="text" class="form-control" id="codigo">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label filtro-label">Categoria</label>
                    <select class="form-control" id="categoria_id">
                        <option value="" selected>Seleccione una categoria</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                        @endforeach 
                 </select>
                </div>
            </form>
            <div class="col-md-12 mb-3 text-end">
                <button class="btn me-2 btn-primary" id="buscarBtn">Buscar</button>
                <button class="btn me-2 btn-primary" id="limpiarBtn">Limpiar </button>
                <button class="btn btn-primary" id="nuevoBtn">Nuevo </button>
            </div>
            <div class="col-md-12 mb-3">
                <table class="table" id="table" data-bs-theme="dark">
                    <thead class="table table-dark" >
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Codigo</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Categoria</th>
                            <th scope="col" width="15%"></th>
                        </tr>
                    </thead>
                    <tbody >
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <script src="{{ asset('js/inventario.js') }}" defer></script>
@endpush
