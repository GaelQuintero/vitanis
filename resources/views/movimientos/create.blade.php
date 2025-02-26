@extends('templates.base')
@section('body')
    <form class="row" id="registroMovimientoForm" autocomplete="off">

        <div class="col-md-12 mb-3">
            <label class="form-label filtro-label">Producto</label>
            <select class="form-control" id="producto_id" name="producto_id">
                <option value="" selected>Seleccione un producto</option>
                @foreach ($productos as $producto)
                    <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-12 mb-3">
            <label class="form-label filtro-label">Tipo de movimiento</label>
            <select class="form-control" id="tipo" name="tipo">
                <option value="" selected>Seleccione una categoria</option>
                <option value="entrada">Entrada</option>
                <option value="salida">Salida</option>
            </select>
        </div>

        <div class="col-md-12 mb-3">
            <label class="form-label" for="cantidad">Cantidad *</label>
            <input type="text" class="form-control" name="cantidad" id="cantidad" required>
        </div>

        <div class="col-md-12 mb-3">
            <label class="form-label" for="descripcion">Descripción *</label>
            <textarea type="text" class="form-control" name="descripcion" id="descripcion" required></textarea>
        </div>

        <div class="text-end">
            <button onclick="registrar();" class="btn btn-primary">Registrar</button>
        </div>
    </form>
@endsection
