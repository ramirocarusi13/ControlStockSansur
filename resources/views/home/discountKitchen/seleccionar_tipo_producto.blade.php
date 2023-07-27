<!DOCTYPE html>
@extends('components.layout.nav')
@section('title')
    Seleccionar Tipo
@endsection
@section('main-content')

    <div class="hero is-fullheight is-dark">
        <div class="hero-body">
            <div class="container_seleccion">
                {{-- <title>Selección de producto</title>
                <h2>Selecciona el tipo de producto:</h2>
                <form method="POST" action="{{ route('producto.subtipo') }}" class="form">
                    @csrf
                    <div class="button-group">
                        <button type="submit" name="tipo" value="cocina" class="btn">Cocina</button>
                        <button type="submit" name="tipo" value="anafe" class="btn">Anafe</button>
                        <button type="submit" name="tipo" value="calefactor" class="btn">Calefactor</button>
                        <button type="submit" name="tipo" value="garrafera" class="btn">Garrafera</button>
                    </div>
                </form> --}}
                <title>Selección de producto</title>
                <h2>Selecciona el tipo de producto:</h2>

                <form method="POST" action="{{ route('producto.subtipo') }}" class="form">
                    @csrf
                    <div class="button-group">
                        <button type="submit" name="tipo" value="cocina" class="btn">Cocina</button>
                        <button type="submit" name="tipo" value="anafe" class="btn">Anafe</button>
                        <button type="submit" name="tipo" value="calefactor" class="btn">Calefactor</button>
                        <button type="submit" name="tipo" value="garrafera" class="btn">Garrafera</button>
                    </div>
                </form>

                @if (isset($selectedTipo))
                    <h2>Selecciona el subtipo de {{ $selectedTipo }}:</h2>

                    <form method="POST" action="{{ route('producto.otra-accion') }}" class="form">
                        @csrf
                        <div class="button-group">
                            @foreach ($subtipos as $subtipo)
                                <button type="submit" name="subtipo" value="{{ $subtipo }}"
                                    class="btn">{{ $subtipo }}</button>
                            @endforeach
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
