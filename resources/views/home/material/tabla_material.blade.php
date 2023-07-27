@extends('home.material.tabla')

@section('title')
    Materiales
@endsection

@section('list')
    @auth

        <div class="box" style="">

            <div class="box p-3 has-background-grey-lighter is-shadowless">
                <div class="columns is-vcentered is-flex is-justify-content-flex-start">
                    <div class="column is-4">
                        <p class="has-text-centered">Codigo Material</p>
                    </div>
                    <div class="column is-3">
                        <p class="has-text-centered">Nombre</p>
                    </div>
                    <div class="column is-3">
                        <p class="has-text-centered">Stock</p>
                    </div>
                </div>
            </div>
            <div class="list" style="max-height: 60vh; overflow-y: auto;">
                @foreach ($materials as $material)
                    <div class="box p-3 mb-1 has-background-white-ter is-shadowless">
                        <div class="columns is-vcentered is-flex is-justify-content-center">
                            <div class="column is-4">
                                <p class="has-text-centered">{{ $material['product_code'] }}</p>
                            </div>
                            <div class="column is-3">
                                <p class="has-text-centered">{{ $material['name'] }}</p>
                            </div>
                            <div class="column is-3">
                                <p class="has-text-centered">{{ $material['stock'] }}</p>
                            </div>
                            <div class="column is-flex is-justify-content-flex-end">
                                <a href="#" class="add-stock-button" data-material-id="{{ $material->id }}">
                                    <span class="icon is-medium is-size-large">
                                        <i class="bx bx-plus-circle has-text-success"></i>
                                    </span>
                                </a>
                                <a href="#" class="delete-icon" data-material-id="{{ $material->id }}">
                                    <span class="icon is-medium is-size-large">
                                        <i class="bx bx-trash has-text-danger pl-3"></i>
                                    </span>
                                </a>

                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Modal para agregar stock -->
            <div class="modal" id="modalAgregarStock">
                <div class="modal-background"></div>
                <div class="modal-card">
                    <header class="modal-card-head">
                        <p class="modal-card-title">Agregar Stock</p>
                        <button class="delete" aria-label="close" id="btnCerrarModalAgregarStock"></button>
                    </header>
                    <section class="modal-card-body">
                        <!-- Aquí va el formulario para agregar el stock -->
                        <form id="formularioAgregarStock" method="post">
                            @csrf
                            <div class="field">
                                <label class="label">Cantidad a Agregar</label>
                                <div class="control">
                                    <input class="input" type="number" name="stock_to_add" placeholder="Cantidad">
                                </div>
                            </div>
                        </form>
                    </section>
                    <footer class="modal-card-foot">
                        <button class="button is-success" id="btnAgregarStock">Agregar</button>
                        <button class="button" id="btnCancelarModalAgregarStock">Cancelar</button>
                    </footer>
                </div>
            </div>

            <!-- Aquí va el resto del contenido de tu vista -->
            @if (session()->has('success'))
                <div class="notification is-success">
                    {{ session('success') }}
                </div>
            @endif


            <script>
                document.addEventListener('DOMContentLoaded', function() {

                    const deleteIcons = document.querySelectorAll('.delete-icon');
                    const btnAgregarStock = document.getElementById('btnAgregarStock');
                    const modalAgregarStock = document.getElementById('modalAgregarStock');
                    const btnCerrarModalAgregarStock = document.getElementById('btnCerrarModalAgregarStock');
                    const btnNuevo = document.getElementById('btnAbrirModal');
                    const modalNuevo = document.getElementById('modalNuevo');
                    const btnCerrarModal = document.getElementById('btnCerrarModal');
                    const btnCancelarModal = document.getElementById('btnCancelarModal');
                    const btnGuardarMaterial = document.getElementById('btnGuardarMaterial');
                    const formularioGuardar = document.getElementById('formularioGuardar');
                    const addStockButtons = document.querySelectorAll('.add-stock-button');
                    addStockButtons.forEach(function(button) {
                        button.addEventListener('click', function() {
                            modalAgregarStock.classList.add('is-active');
                            const materialId = this.getAttribute('data-material-id');
                            document.getElementById('formularioAgregarStock').setAttribute('action',
                                `/material/add-stock/${materialId}`);
                        });
                    });
                    btnAgregarStock.addEventListener('click', function() {
                        fetch(formularioAgregarStock.action, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Content-Type': 'application/x-www-form-urlencoded',
                                },
                                body: new URLSearchParams(new FormData(formularioAgregarStock)),
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    modalAgregarStock.classList.remove('is-active');
                                    const notification = document.createElement('div');
                                    notification.classList.add('notification', 'is-success');
                                    notification.innerText = data.message;
                                    document.body.appendChild(notification);

                                    setTimeout(function() {
                                        location.reload();
                                    }, 1000);
                                }
                            })
                            .catch(error => {
                                console.error('Error al agregar stock:', error);
                            });
                    });
                    btnCerrarModalAgregarStock.addEventListener('click', function() {
                        modalAgregarStock.classList.remove('is-active');
                    });


                    deleteIcons.forEach(function(icon) {
                        icon.addEventListener('click', function(event) {
                            event.preventDefault();


                            const materialId = this.getAttribute('data-material-id');


                            const confirmDelete = window.confirm(
                                '¿Estás seguro de que deseas desactivar este material?');

                            if (confirmDelete) {
                                fetch(`/material/deactivate/${materialId}`, {
                                        method: 'POST',
                                        headers: {
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        },
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.success) {
                                            const materialContainer = document.getElementById(
                                                `material_${materialId}`);
                                            materialContainer.style.display = 'none';
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Error al desactivar el material:', error);
                                    });
                            }
                        });
                    });
                });
            </script>



        </div>
        {{ $materials->links() }}


    @endauth
@endsection
