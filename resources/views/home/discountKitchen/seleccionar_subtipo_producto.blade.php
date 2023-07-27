
@extends('components.layout.nav')

@section('title')
    Seleccionar Subtipo
@endsection

@section('main-content')

    <div class="hero is-fullheight is-dark">
        <div class="hero-body">
            <div class="container_seleccion">
                <div class="title">
                    <h2>Selecciona el subtipo de {{ $tipo }}:</h2>
                </div>
        
                <form method="POST" action="{{ route('producto.opciones') }}">
                    @csrf
                    <input type="hidden" name="tipo" value="{{ $tipo }}">
        
                    <div class="button-group">
                        @foreach ($subtipos as $subtipo)
                            <button type="submit" name="subtipo" value="{{ $subtipo }}" class="btn">{{ ucfirst(str_replace('_', ' ', $subtipo)) }}</button>
                        @endforeach
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
    </html>
