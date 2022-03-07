@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col">
        <img src="{{$pelicula['poster']}}" style="height:400px;float:right;" />
    </div>
    <div class="col-sm-8">
        <br>
        <h1>{{$pelicula['title']}}</h1>
        <h4>Año: {{$pelicula['year']}}</h4>
        <h4>Director: {{$pelicula['director']}}</h4>
        <br>
        <h5><strong>Resumen: </strong>{{$pelicula['synopsis']}}</h5>
        <br>
        <h5><strong>Estado:</strong>
            @if ($pelicula['rented'])
            Película actualmente alquilada
            @else
            Película disponible
            @endif
        </h5>
        <br>
        <div class="d-grid gap-2 d-md-block">
            @if ($pelicula['rented'])
            <a class="btn btn-danger" role="button">Devolver película</a>
            @else
            <a class="btn btn-primary" role="button">Alquilar película</a>
            @endif
            <a href="{{ url('/catalog/edit/' . $id ) }}" class="btn btn-warning" role="button"><i class="fa fa-pencil" aria-hidden="true"></i> Editar película</a>
            <a href="{{ url('/catalog') }}" class="btn btn-light" role="button"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver al listado</a>
        </div>
    </div>
</div>
@stop
