@extends('components.layout.nav')

@section('title')
    Inicio
@endsection

@section('main-content')

    <div class="hero is-fullheight is-light">
        <div class="hero-body">
            <div class="container">
                
                @if (Auth::user()->access_level <= 2)
                
                    <div class="section">
                        <div class="columns is-vcentered">
                            <div class="column has-text-centered is-offset-1 is-2">
                                <a href="{{ route('home.material.tabla_material') }}">
                                    <div class="box has-text-centered">
                                        <i class="icon is-large is-size-1 bx bx-money"></i>
                                        <br>
                                        <p>Stock</p>
                                    </div>
                                </a>
                            </div>
                            <div class="column has-text-centered is-offset-2 is-2">
                                <a href="{{ route('home.discountKitchen.seleccionar_tipo_producto')}}">
                                    <div class="box has-text-centered">
                                        <i class="icon is-large is-size-1 bx bx-box"></i>
                                        <br>
                                        <p>Descontar cocina de stock</p>
                                    </div>
                                </a>
                            </div>
                            <div class="column has-text-centered is-offset-2 is-2">
                                <a href="">
                                    <div class="box has-text-centered">
                                        <i class="icon is-large is-size-1 bx bx-wallet"></i>
                                        <br>
                                        <p>Pedido Stock</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                @endif

                @if (Auth::user()->access_level >= 3)
                    
                    <div class="section">
                        <div class="columns is-vcentered">
                            <div class="column has-text-centered is-offset-1 is-2">
                                <a href="">
                                    <div class="box has-text-centered">
                                        <i class="icon is-large is-size-1 bx bx-user"></i>
                                        <br>
                                        <p>Usuarios</p>
                                    </div>
                                </a>
                            </div>
                            <div class="column has-text-centered is-offset-2 is-2">
                                <a href="">
                                    <div class="box has-text-centered">
                                        <i class="icon is-large is-size-1 bx bx-book"></i>
                                        <br>
                                        <p>Documentos</p>
                                    </div>
                                </a>
                            </div>
                            <div class="column has-text-centered is-offset-2 is-2">
                                <a href="{{ route('products') }}">
                                    <div class="box has-text-centered">
                                        <i class="icon is-large is-size-1 bx bx-folder"></i>
                                        <br>
                                        <p>Productos</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>


                    <div class="section">
                        <div class="columns is-vcentered">
                            <div class="column has-text-centered is-offset-1 is-2">
                                <a href="">
                                    <div class="box has-text-centered">
                                        <i class="icon is-large is-size-1 bx bx-wallet"></i>
                                        <br>
                                        <p>Créditos</p>
                                    </div>
                                </a>
                            </div>
                            <div class="column has-text-centered is-offset-2 is-2">
                                <a href="{{ route('materials') }}">
                                    <div class="box has-text-centered">
                                        <i class="icon is-large is-size-1 bx bx-money"></i>
                                        <br>
                                        <p>Stock</p>
                                    </div>
                                </a>
                            </div>
                            <div class="column has-text-centered is-offset-2 is-2">
                                <a href="">
                                    <div class="box has-text-centered">
                                        <i class="icon is-large is-size-1 bx bx-cog"></i>
                                        <br>
                                        <p>Configuración</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                @endif
            </div>
        </div>
    </div>
    
@endsection