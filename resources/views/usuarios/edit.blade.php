@extends('templates.base')
@section('body')
    <form class="row" id="editFormUsuarios" autocomplete="off">
        <div class="col-md-12 mb-3">
            <label class="form-label" for="name">Nombre *</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ $usuarios->name }}" required>
        </div>
        <div class="col-md-12 mb-3">
            <label class="form-label" for="email">E-mail *</label>
            <input type="text" class="form-control" name="email" id="email" value="{{ $usuarios->email }}" required>
        </div>
        <div class="col-md-12 mb-3">
            <label class="form-label" for="rol">Rol *</label>
            <select class="form-select" name="rol" id="rol" aria-label="Default select example">
                <option selected>Selecciona un rol</option>
                <option value="1">Administrador</option>
                <option value="2">Solo lectura</option>
            </select>
        </div>

        <div class="text-end">
            <button onclick="update({{$usuarios->id}});" class="btn btn-primary">Actualizar</button>
        </div>
    </form>
@endsection
