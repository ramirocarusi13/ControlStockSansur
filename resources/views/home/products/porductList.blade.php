@section('list')

    @auth
        
        <div class="box">
        
            <div class="box p-3 has-background-grey-lighter is-shadowless">
                <div class="columns is-vcentered">
                    <div class="column is-2">
                        <p>Codigo Producto</p>
                    </div>
                    <div class="column is-2">
                        <p>Nombre</p>
                    </div>
                    <div class="column is-2">
                        <p>Tipo</p>
                    </div>
                    <div class="column is-3">
                        <p>Stock</p>
                    </div>
                </div>
            </div>

            <div class="list" style="max-height: 60vh; overflow-y: auto;">
            
                @foreach (session('users') as $user)
                
                    <a href="{{ route('users.details', ['id' => $user['id']]) }}">
                        <div class="box p-3 mb-1 has-background-white-ter is-shadowless">
                            <div class="columns is-vcentered">
                                <div class="column is-2">
                                    <p>{{ $user['dni'] }}</p>
                                </div>
                                <div class="column is-2">
                                    <p>{{ $user['last_name'] }}</p>
                                </div>
                                <div class="column is-2">
                                    <p>{{ $user['first_name'] }}</p>
                                </div>
                                <div class="column is-3">
                                    <p class="is-clipped">{{ $user['email'] }}</p>
                                </div>
                                <div class="column is-3">
                                    @if ($user['phone_number'] !== null)
                                    <p class="is-clipped">{{ $user['phone_number'] }}</p>
                                    @else
                                    <p class="is-clipped">No especificado</p>
                                    @endif
                                </div>
                                
                            </div>
                        </div>
                    </a>
                    
                @endforeach

            </div>
        </div>
        
    @endauth
    
@endsection