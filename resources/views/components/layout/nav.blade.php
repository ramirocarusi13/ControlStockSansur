@extends('components.layout.app')

@section('style')
    <style>
        .is-sansur {
            background-color: #e1edf0;
        }
    </style>
@endsection

@section('content')


   <nav id="navbar" class="navbar is-sansur is-dark" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
      <a class="navbar-item" href="{{ route('home.home') }}">
        <img src="{{ asset('img/Escudo_de_Chubut.svg') }}" width="112" height="28">
      </a>
  
      <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
      </a>
    </div>
  
    <div id="navbarBasicExample" class="navbar-menu">
      <div class="navbar-start">
        <a class="navbar-item" href="{{ route('home.home') }}">
          Inicio
        </a>
  
        @if (Auth::user()->access_level <= 2)
        <a class="navbar-item" href="">    
        @else
        <a class="navbar-item" href="">
        @endif
          Documentos
        </a>
  
        @if (Auth::user()->access_level >= 3)
        <div class="navbar-item has-dropdown is-hoverable">
          <a class="navbar-link">
            More
          </a>
  
          <div class="navbar-dropdown">
            <a class="navbar-item">
              About
            </a>
            <a class="navbar-item">
              Jobs
            </a>
            <a class="navbar-item">
              Contact
            </a>
            <hr class="navbar-divider">
            <a class="navbar-item">
              Report an issue
            </a>
          </div>
        </div>
        @endif
      </div>
  
      <div class="navbar-end">
        <div class="navbar-item">
          <p>{{ Auth::user()->business_name }}</p>
        </div>
        <div class="navbar-item">
          <div class="buttons">
            <a class="button is-dark" href="">
              <strong>Mi perfil</strong>
            </a>
            <a class="button is-dark" href="+*----">
              Cerrar sesión
            </a>
          </div>
        </div>
      </div>
    </div>
  </nav>
  
  @yield('main-content')
  

  
    

@endsection