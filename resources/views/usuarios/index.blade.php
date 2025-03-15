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
                <h4>Usuarios</h4>
            </div>
            <form class="row" id="filterForm">
                <div class="col-md-4 mb-3">
                    <label class="form-label filtro-label">Nombre</label>
                    <input type="text" class="form-control" id="name" >
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label filtro-label">E-mail</label>
                    <input type="text" class="form-control" id="email">
                </div>
            </form>
            <div class="col-md-12 mb-3 text-end">
                <button class="btn me-2 btn-primary" id="buscarBtn">Buscar</button>
                <button class="btn me-2 btn-primary" id="limpiarBtn">Limpiar </button>
                <button class="btn btn-primary" id="nuevoBtn">Nuevo</button>
            </div>
            <div class="col-md-12 mb-3">
                <table class="table" id="tableUsuarios" data-bs-theme="dark">
                    <thead class="table table-dark" >
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Fecha de registro</th>
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
    <script src="{{ asset('js/usuarios.js') }}" defer></script>
@endpush
