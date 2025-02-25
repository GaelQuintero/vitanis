@extends('templates.base')

@section('title','Inicio')


@section('body')
<div class="row">
    <div class="col-md-6">Hola mundo</div>
    <div class="col-md-6">
        <a href="{{route('inventario')}}">Hola</a>
    </div>
</div>
@endsection
