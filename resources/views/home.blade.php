@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-center">  {{-- Tarjeta con contenido centrado --}}
                <div class="card-header">---------- LAS MEJORES FOTOS EN UN SOLO LUGAR  ---------</div>  {{-- Texto o mensaje que se muestra en la Tarjeta --}}

                <div class="card-body">
                    <form method="POST" action="{{ url('/home') }}"> {{-- Formulario que envía datos por medio de POST a /home mediante el URL --}}
                        @csrf
                        <div class="form-group">
                            <input type="text" name="textBuscado" class="form-control" placeholder="Ingresa el texto de la foto que deseas buscar" required> {{-- campo de texto que se le solicita al usuario para la busqueda de la foto --}}
                        </div>
                        <div class="form-group mt-2">
                            <button class="btn btn-outline-primary waves-effect waves-light" type="submit">Buscar las fotos</button> {{-- Botón para enviar la solicitud --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><br>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row">
                @foreach ($photos as $photo) {{-- Muestra foto una a una ya que recorre cada elemento dentro del array $photos de cada elemento de la variable $photo,  --}}
                <div class="col-md-3 mb-3">
                    <div class="card">
                        <div style="height: 200px; overflow: hidden;">
                            <img src="{{ $photo['urls']['small'] }}" class="card-img-top" style="object-fit: cover; width: 100%; height: 100%;" alt="{{ $photo['description'] ?? 'Photo' }}">
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{ $alt_description_es = $photo['alternative_slugs']['es']; }}</p> {{-- Muestra una descripción alternativa en español para la foto --}}
                            <a class="btn btn-link" href="{{ $photo['links']['download'] }}" style="color: #0d3e66;" target="_blank">Ver y descargar</a> {{-- Enlace para ver y descargar la foto original --}}
                        </div>
                    </div> 
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection