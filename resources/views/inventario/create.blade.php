@extends('templates.base')
@section('body')
    <form class="row" id="registroProductoForm" autocomplete="off">
        <div class="col-md-12 mb-3">
            <label class="form-label" for="nombre">Nombre *</label>
            <input type="text" class="form-control" name="nombre" id="nombre" required>
        </div>
        <div class="col-md-12 mb-3">
            <label class="form-label" for="descripcion">Descripción *</label>
            <textarea type="text" class="form-control" name="descripcion" id="descripcion" required></textarea>
        </div>
        <div class="col-md-12 mb-3">
            <label class="form-label" for="codigo">Codigo *</label>
            <input type="text" class="form-control" name="codigo" id="codigo" required>
        </div>
        <div class="col-md-12 mb-3">
            <label class="form-label" for="cantidad_actual">Cantitad actual *</label>
            <input type="text" class="form-control" name="cantidad_actual" id="cantidad_actual" required>
        </div>
        <div class="col-md-12 mb-3">
            <label class="form-label" for="precio">Precio *</label>
            <input type="text" class="form-control" name="precio" id="precio" required>
        </div>
        
        <div class="col-md-12 mb-3">
            <label class="form-label filtro-label">Categoria</label>
            <select class="form-control" id="categoria_id" name="categoria_id">
                <option value="" selected>Seleccione una categoria</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                @endforeach 
         </select>
        </div>

        <div class="text-end">
            <button onclick="registrar();" class="btn btn-primary">Registrar</button>
        </div>
    </form>
@endsection
