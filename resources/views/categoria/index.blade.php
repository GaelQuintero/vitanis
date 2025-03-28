@extends('templates.base')

@section('title', env('APP_NAME') . ' - Categorias')
@extends('templates.nav')
@section('body')
    <div class=" container p-4 animate__animated animate__fadeIn" data-bs-theme="dark">
        <div class="row">
            {{-- <div class="col-md-12 mb-3 text-end">
                <a class="btn btn-primary rounded-3" href="{{route('dashboard')}}">Volver</a>
            </div> --}}
            <div class="col-md-12 mb-3 ">
                <h4>Categorias</h4>
            </div>
            <form class="row" id="filterForm">
                <div class="col-md-4 mb-3">
                    <label for="sexo" class="form-label filtro-label">Categoria</label>
                    <input type="text" class="form-control" id="categoria" placeholder="Categoria">
                </div>
            </form>
            <div class="col-md-12 mb-3 text-end">
                <button class="btn me-2 btn-primary" id="buscarBtn">Buscar</button>
                <button class="btn me-2 btn-primary" id="limpiarBtn">Limpiar </button>
                @if (Auth::user()->rol === 1)
                <button class="btn btn-primary" id="nuevoBtn">Nuevo</button>
                @endif
            </div>
            <div class="col-md-12 mb-3">
                <table class="table" id="tableCategoria" data-bs-theme="dark">
                    <thead class="table table-dark" >
                        <tr>
                            <th scope="col">Nombre</th>
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
    <script src="{{ asset('js/categoria.js') }}" defer></script>
    <script> const currentUserRol = {{ Auth::user()->rol ?? 0 }};</script>
@endpush
