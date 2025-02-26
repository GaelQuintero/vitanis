@extends('templates.base')
@section('body')
    <form class="row" id="editForm" autocomplete="off">
        <div class="col-md-12 mb-3">
            <label class="form-label" for="nombre">Nombre *</label>
            <input type="text" class="form-control" name="nombre" id="nombre" value="{{ $inventario->nombre }}" required>
        </div>
        <div class="col-md-12 mb-3">
            <label class="form-label" for="descripcion">Descripción *</label>
            <textarea type="text" class="form-control" name="descripcion" id="descripcion" required>{{ $inventario->descripcion }}</textarea>
        </div>
        <div class="col-md-12 mb-3">
            <label class="form-label" for="codigo">Codigo *</label>
            <input type="number" class="form-control" name="codigo" id="codigo" value="{{ $inventario->codigo }}" required>
        </div>
        <div class="col-md-12 mb-3">
            <label class="form-label" for="cantidad_actual">Cantitad actual *</label>
            <input type="number" class="form-control" name="cantidad_actual" id="cantidad_actual" value="{{ $inventario->cantidad_actual }}" required>
        </div>
        <div class="col-md-12 mb-3">
            <label class="form-label" for="precio">Precio *</label>
            <input type="number" class="form-control" name="precio" id="precio" value="{{ $inventario->precio }}" required>
        </div>

        <div class="col-md-12 mb-3">
            <label class="form-label">Categoria *</label>
            <select class="form-control" name="categoria_id" required>
                <option value="" selected>Seleccione una opción</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}"
                        {{ isset($inventario) && $inventario->categoria_id == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="text-end">
            <button onclick="update({{$inventario->id}});" class="btn btn-primary">Actualizar</button>
        </div>
    </form>
@endsection
