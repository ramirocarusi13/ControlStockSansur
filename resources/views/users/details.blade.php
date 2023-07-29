@extends('components.layout.nav')

@section('title')
    Datos de usuario
@endsection

@section('main-content')

    <div class="hero is-fullheight has-background-light">
        <div class="hero-body is-flex justify-content-center">
            <div class="container">

                
                @if (session('status') != null)

                    <div class="columns is-centered is-vcentered">
                        <div class="column is-two-fifths">
                            <div class="notification is-success">
                                <p class="has-text-centered">{{ session('status') }}</p>
                            </div>
                        </div>
                    </div>
                
                @endif
                

                <div class="columns is-centered is-vcentered">
                    
                    <div class="column is-one-third">
                        

                        @if ($user != null)

                        <div class="box">

                            <form action="{{ route('user.update', ['id' => $user->id]) }}" method="post">
                                
                                @csrf
                                @method('PUT')
                            
                                <div class="field">
                                    <label class="label">DNI</label>
                                    <div class="control has-icons-left">
                                        <input class="input" type="text" name="dni" value="{{ $user->dni }}">
                                        <span class="icon is-small is-left">
                                            <i class="bx bxs-id-card"></i>
                                        </span>
                                    </div>
                                </div>
                            
                                <div class="field">
                                    <label class="label">Apellido</label>
                                    <div class="control has-icons-left">
                                        <input class="input" type="text" name="last_name" value="{{ $user->last_name }}">
                                        <span class="icon is-small is-left">
                                            <i class="bx bxs-id-card"></i>
                                        </span>
                                    </div>
                                </div>
                            
                                <div class="field">
                                    <label class="label">Nombre</label>
                                    <div class="control has-icons-left">
                                        <input class="input" type="text" name="first_name" value="{{ $user->first_name }}">
                                        <span class="icon is-small is-left">
                                            <i class="bx bxs-id-card"></i>
                                        </span>
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label">Teléfono de contacto</label>
                                    <div class="control has-icons-left">
                                        <input class="input" type="text" name="phone_number"
                                        @if ($user->phone_number == null)
                                        value="No especificado">
                                        @else
                                        value="{{ $user->phone_number }}">
                                        @endif
                                        <span class="icon is-small is-left">
                                            <i class="bx bx-phone"></i>
                                        </span>
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label">Correo electrónico</label>
                                    <div class="control has-icons-left">
                                        <input class="input" type="text" name="email" value="{{ $user->email }}">
                                        <span class="icon is-small is-left">
                                            <i class="bx bx-envelope"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="level-item has-text-centered">
                                        <div class="field is-grouped pt-3">
                                            {{-- If access level of user requested is minor to actual user
                                                or if user requested is the same as user who login --}}
                                            @if ($user->access_level < Auth::user()->access_level || $user->dni == Auth::user()->dni)
                                            <div class="control">
                                                <button class="button is-success" type="submit">Guardar</button>
                                            </div>
                                            @endif

                                            
                                            <div class="control">
                                                <a href="">
                                                    <button type="button" class="button is-link is-light">Volver</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>

                        </div>


                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection