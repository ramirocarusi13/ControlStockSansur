@extends('users.users')

@section('title')
    Usuarios
@endsection

@section('list')
    @auth

        <div class="box" style="">
            <div class="box p-3 has-background-grey-lighter is-shadowless">
                <div class="columns is-vcentered is-flex is-justify-content-flex-start">
                    <div class="column is-2">
                        <p class="has-text-centered">Nombre</p>
                    </div>
                    <div class="column is-2">
                        <p class="has-text-centered">Apellido</p>
                    </div>
                    <div class="column is-2">
                        <p class="has-text-centered">Dni</p>
                    </div>
                    <div class="column is-3">
                        <p class="has-text-centered">Email</p>
                    </div>
                    <div class="column is-2">
                        <p class="has-text-centered">Acceso level</p>
                    </div>
                </div>
            </div>
            <div class="list" style="max-height: 60vh; overflow-y: auto;">
                @foreach ($users as $user)
                    <div class="box p-3 mb-1 has-background-white-ter is-shadowless">
                        <div class="columns is-vcentered is-flex is-justify-content-center">
                            <div class="column is-2">
                                <p class="has-text-centered">{{ $user['first_name'] }}</p>
                            </div>
                            <div class="column is-2 ">
                                <p class="has-text-centered">{{ $user['last_name'] }}</p>
                            </div>
                            <div class="column is-2">
                                <p class="has-text-centered">{{ $user['dni'] }}</p>
                            </div>
                            <div class="column is-3">
                                <p class="has-text-centered">{{ $user['email'] }}</p>
                            </div>
                            <div class="column is-2">
                                <p class="has-text-centered">{{ $user['access_level'] }}</p>
                            </div>
                            <div class="column is-flex is-justify-content-flex-end">
                                <a href="{{ route('users.details', ['id' => $user['id']]) }}" class="edit-button" data-user-id="{{ $user->id }}">
                                    <span class="icon is-medium is-size-large">
                                        <i class="bx bx-edit has-text-dark"></i>
                                    </span>
                                </a>

                                <a href="#" class="eliminar-usuario" data-user-id="{{ $user->id }}">
                                    <span class="icon is-medium is-size-large">
                                        <i class="bx bx-trash has-text-danger pl-3"></i>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        

        <!-- Agrega aquí las etiquetas script necesarias, como Vue, Axios, etc. -->







        <!-- Agrega este código en la vista "users.usersList" -->
        <div id="confirmarModal" class="modal">
            <div class="modal-content">
                <span class="close" id="modalClose">&times;</span>
                <p>¿Estás seguro de que deseas eliminar este usuario?</p>
                <button class="btn-cancel" id="cancelBtn">Cancelar</button>
                <button class="btn-confirm" id="confirmBtn">Eliminar</button>
            </div>
        </div>

        <!-- Agrega este código en la vista "users.usersList" -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const eliminarUsuarioButtons = document.querySelectorAll('.eliminar-usuario');

                eliminarUsuarioButtons.forEach(button => {
                    button.addEventListener('click', function(event) {
                        event.preventDefault();

                        const userId = button.dataset.userId;

                        // Muestra el cuadro de diálogo de confirmación del navegador
                        const confirmarEliminacion = window.confirm(
                            '¿Estás seguro de que deseas eliminar este usuario?');

                        if (confirmarEliminacion) {
                            // Si el usuario confirma, realiza la redirección al controlador para desactivar al usuario
                            fetch(`/users/desactivar/${userId}`, {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Content-Type': 'application/json'
                                    }
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        // Usuario desactivado correctamente, muestra notificación y recarga la página
                                        const notification = document.createElement('div');
                                        notification.className = 'notification is-success';
                                        notification.innerText = 'Usuario eliminado exitosamente';
                                        document.body.appendChild(notification);

                                        setTimeout(() => {
                                            notification.remove();
                                        }, 1000);

                                        // Recargar la página después de un corto período de tiempo (3 segundos)
                                        setTimeout(() => {
                                            window.location.reload();
                                        }, 500);
                                    } else {
                                        // Mostrar mensaje de error si es necesario
                                        const notification = document.createElement('div');
                                        notification.className = 'notification is-danger';
                                        notification.innerText =
                                            'Ocurrió un error al eliminar el usuario';
                                        document.body.appendChild(notification);

                                        setTimeout(() => {
                                            notification.remove();
                                        }, 3000);
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    const notification = document.createElement('div');
                                    notification.className = 'notification is-danger';
                                    notification.innerText =
                                        'Ocurrió un error al eliminar el usuario';
                                    document.body.appendChild(notification);

                                    setTimeout(() => {
                                        notification.remove();
                                    }, 3000);
                                });
                        } else {
                            // Si el usuario cancela, no se realiza ninguna acción
                        }
                    });
                });
            });
        </script>



        </div>


    @endauth
@endsection
