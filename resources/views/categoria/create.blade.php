@extends('templates.base')
@section('body')
    <form class="row" id="registroCategoriaForm" autocomplete="off">
        <div class="col-md-12 mb-3">
            <label class="form-label" for="nombre">Nombre *</label>
            <input type="text" class="form-control" name="nombre" id="nombre" required>
        </div>

        <div class="text-end">
            <button onclick="registrar();" class="btn btn-primary">Registrar</button>
        </div>
    </form>
@endsection
