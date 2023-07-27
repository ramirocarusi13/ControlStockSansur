@extends('components.layout.app') 

@section('title')
    Sansur Login
@endsection

@section('content')
<div class="hero is-fullheight is-light">

    <div class="hero-body is-flex justify-content-center">
        

        <div class="container">
            
            

            <div class="columns is-centered is-vcentered">
                

                <div class="column is-one-third">

                    @if (session('status') != null)

                        <div class="columns is-centered is-vcentered">
                            <div class="column is-10">
                                <div class="notification is-success">
                                    <p class="has-text-centered">{{ session('status') }}</p>
                                </div>
                            </div>
                        </div>
                    
                    @endif

                    @if (session('problem') != null)

                        <div class="columns is-centered is-vcentered">
                            <div class="column is-11">
                                <div class="notification is-danger">
                                    <p class="has-text-centered">{{ session('problem') }}</p>
                                </div>
                            </div>
                        </div>
                    
                    @endif

                    <div class="box">

                        <form action="{{ route('logins.login') }}" method="post">

                            @csrf
                            <div class="field pt-2">
                                <label class="label_login">Correo electrónico</label>
                                <div class="control has-icons-left has-icons-right">
                                    <input class="input" type="text" name="email" id="email" placeholder="correo@midominio.com.ar" value="">
                                    <span class="icon is-small is-left">
                                        <i class="bx bx-user"></i>
                                    </span>
                                </div>
                            </div>
                            
                            <div class="field pt-2">
                                <label class="label_login">Contraseña</label>
                                <div class="control has-icons-left has-icons-right">
                                    <input class="input" type="password" name="password" id="password" placeholder="***********">
                                    <span class="icon is-small is-left">
                                        <i class="bx bx-key"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="field pt-0 mb-0 is-flex is-justify-content-flex-end">
                                <a href="">
                                    <p class="help">¿Olvidaste la contraseña?</p>
                                </a>
                            </div>

                            <div class="level-item has-text-centered">
                                <div class="field is-grouped pt-3">
                                    <div class="control">
                                        <button type="submit" class="button is-link">Iniciar sesión</button>
                                    </div>
                                    <div class="control">
                                        <a href="{{ route('register.view') }}" class="button is-link">Registrarse</a>
                                    </div>
                                </div>
                            </div>
                            

                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection