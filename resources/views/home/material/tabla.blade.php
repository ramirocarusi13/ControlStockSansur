@extends('components.layout.nav')

@section('main-content')
    <div class="hero is-fullheight is-light">
        <div class="hero-body">
            <div class="container">

                <div class="column is-fourth-fifhts">
                    <div class="column is-offset-1 is-10">
                        


                        {{-- Search form --}}
                        <div class="box">
                            <form action="{{ route('material.buscar') }}" method="post">
                                @csrf
                                <div class="columns">
                                    <div class="column">
                                        <div class="field">
                                            <div class="control">
                                                <a href="{{ route('home.home') }}">
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
                                                        <option value="id">Codigo</option>
                                                        <option value="name">Nombre</option>
                                                        <option value="stock">Cantidad</option>
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
                            <!-- Modal para agregar un nuevo material -->
                            <div class="modal" id="modalNuevo">
                                <div class="modal-background"></div>
                                <div class="modal-card">
                                    <header class="modal-card-head">
                                        <p class="modal-card-title">Agregar Nuevo Material</p>
                                        <button class="delete" aria-label="close" id="btnCerrarModal"></button>
                                    </header>
                                    <section class="modal-card-body">
                                        <!-- Aquí va el formulario para agregar el nuevo material -->
                                        <form id="formularioGuardar" action="{{ route('material.create') }}" method="post">
                                            @csrf
                                            <div class="field">
                                                <label class="label">Código Material</label>
                                                <div class="control">
                                                    <input class="input" type="text" name="product_code"
                                                        placeholder="Código Material">
                                                </div>
                                            </div>
                                            <div class="field">
                                                <label class="label">Nombre</label>
                                                <div class="control">
                                                    <input class="input" type="text" name="name"
                                                        placeholder="Nombre">
                                                </div>
                                            </div>
                                            <div class="field">
                                                <label class="label">Stock</label>
                                                <div class="control">
                                                    <input class="input" type="number" name="stock" placeholder="Stock">
                                                </div>
                                            </div>
                                            <!-- Agrega otros campos que desees para el nuevo material -->
                                        </form>
                                    </section>
                                    <footer class="modal-card-foot">
                                        <button class="button is-success" id="btnGuardarMaterial">Guardar</button>
                                        <button class="button" id="btnCancelarModal">Cancelar</button>
                                    </footer>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
        
                                        const btnNuevo = document.getElementById('btnAbrirModal');
                                        const modalNuevo = document.getElementById('modalNuevo');
                                        const btnCerrarModal = document.getElementById('btnCerrarModal');
                                        const btnCancelarModal = document.getElementById('btnCancelarModal');
                                        const btnGuardarMaterial = document.getElementById('btnGuardarMaterial');
                                        const formularioGuardar = document.getElementById('formularioGuardar');
        
        
                                        btnNuevo.addEventListener('click', function() {
                                            modalNuevo.classList.add('is-active');
                                        });
        
        
                                        btnCerrarModal.addEventListener('click', function() {
                                            modalNuevo.classList.remove('is-active');
                                        });
        
        
                                        btnCancelarModal.addEventListener('click', function() {
                                            modalNuevo.classList.remove('is-active');
                                        });
        
        
                                        btnGuardarMaterial.addEventListener('click', function() {
        
                                            fetch(formularioGuardar.action, {
                                                    method: 'POST',
                                                    headers: {
                                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                                        'Content-Type': 'application/x-www-form-urlencoded',
                                                    },
                                                    body: new URLSearchParams(new FormData(formularioGuardar)),
                                                })
                                                .then(response => response.json())
                                                .then(data => {
        
                                                    if (data.success) {
                                                        modalNuevo.classList.remove('is-active');
                                                        const notification = document.createElement('div');
                                                        notification.classList.add('notification', 'is-success');
                                                        notification.innerText = data.message;
                                                        document.body.appendChild(notification);
        
                                                        setTimeout(function() {
                                                            notification.remove();
                                                            // Recargar la página después de eliminar la notificación
                                                            location.reload();
                                                        }, 1000);
        
        
                                                    }
                                                })
                                                .catch(error => {
                                                    console.error('Error al guardar el material:', error);
                                                });
                                        });
                                    });
                                </script>





                            </div>

                        </div>


                        @yield('list')

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
