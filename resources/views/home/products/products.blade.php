@extends('components.layout.nav')

@section('main-content')
    <div class="hero is-fullheight is-light">
        <div class="hero-body">
            <div class="container">

                <div class="column   ">
                    <div class="column is-offset-1 is-10">
                        <div class="box">
                            <form action="" method="post">
                                @csrf
                                <div class="columns">
                                    <div class="column">
                                        <div class="field">
                                            <div class="control">
                                                <a href="">
                                                    <button class="button is-fullwidth is-link" type="button">
                                                        <span class="icon">
                                                            <i class="bx bx-arrow-back"></i>
                                                        </span>
                                                        <span>Volver</span>
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="column is-flex-grow-1 is-half">
                                        <div class="field has-addons">
                                            <div class="control has-icons-left is-expanded">
                                                <input class="input" type="text" name="q" placeholder="Buscar...">
                                                <span class="icon is-small is-left">
                                                    <i class="bx bx-search"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="column">
                                        <div class="field">
                                            <div class="control">
                                                <div class="select">
                                                    <select name="filter_option" id="filter_option">
                                                        <option value="id">Cocinas</option>
                                                        <option value="name">Anafes</option>
                                                        <option value="stock">Calefactores</option>
                                                        <option value="stock">Garrafera</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="column">
                                        <div class="field">
                                            <div class="control">
                                                <button class="button is-fullwidth" type="submit">Buscar</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="column">
                                        <div class="field">
                                            <div class="control">
                                                <div id="btnAbrirModal" class="button is-fullwidth is-success">Nuevo</div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @yield('list')
                    </div>

                </div>
            </div>
        </div>
@endsection
