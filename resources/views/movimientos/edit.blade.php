@extends('templates.base')
@section('body')
    <form class="row" id="editForm" autocomplete="off">

        <div class="col-md-12 mb-3">
            <label class="form-label filtro-label">Producto</label>
            <select class="form-control" id="producto_id" name="producto_id">
                <option value="" selected>Seleccione un producto</option>
                @foreach ($productos as $producto)
                <option value="{{ $producto->producto_id }}"
                    {{ isset($movimiento) && $movimiento->producto_id == $producto->id ? 'selected' : '' }}>
                    {{ $producto->nombre }}
                </option>
            @endforeach
            </select>
        </div>

        <div class="col-md-12 mb-3">
            <label class="form-label filtro-label">Tipo de movimiento</label>
            <select class="form-control" id="tipo" name="tipo">
                <option value="" disabled>Seleccione un tipo de movimiento</option>
                <option value="entrada" {{ old('tipo', $movimiento->tipo ?? '') == 'entrada' ? 'selected' : '' }}>Entrada</option>
                <option value="salida" {{ old('tipo', $movimiento->tipo ?? '') == 'salida' ? 'selected' : '' }}>Salida</option>
            </select>
            
        </div>

        <div class="col-md-12 mb-3">
            <label class="form-label" for="cantidad">Cantidad *</label>
            <input type="text" class="form-control" name="cantidad" id="cantidad" value="{{$movimiento->cantidad}}" required>
        </div>

        <div class="col-md-12 mb-3">
            <label class="form-label" for="descripcion">Descripción *</label>
            <textarea type="text" class="form-control" name="descripcion" id="descripcion" required>{{$movimiento->descripcion}}</textarea>
        </div>

        <div class="text-end">
            <button onclick="update();" class="btn btn-primary">Actualizar</button>
        </div>
    </form>
@endsection
