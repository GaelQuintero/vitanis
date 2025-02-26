@extends('templates.base')
@section('body')
    <form class="row" id="editFormCategoria" autocomplete="off">
        <div class="col-md-12 mb-3">
            <label class="form-label" for="nombre">Nombre *</label>
            <input type="text" class="form-control" name="nombre" id="nombre" value="{{ $categoria->nombre }}" required>
        </div>
        <div class="text-end">
            <button onclick="update({{$categoria->id}});" class="btn btn-primary">Actualizar</button>
        </div>
    </form>
@endsection
