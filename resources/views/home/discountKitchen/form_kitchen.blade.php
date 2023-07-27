<!DOCTYPE html>
<html>
<head>
    <title>Selección de producto</title>
</head>
<body>
    <h2>Selecciona el tipo de producto:</h2>

    <form method="POST" action="">{{ route('producto.subtipo') }}
        @csrf
        <select name="tipo" onchange="this.form.submit()">
            <option value="">Selecciona un tipo de producto</option>
            <option value="cocina">Cocina</option>
            <option value="anafe">Anafe</option>
            <option value="calefactor">Calefactor</option>
            <option value="garrafera">Garrafera</option>
        </select>
    </form>

    @if ($subtipos)
        <h2>Selecciona el subtipo de {{ $tipo }}:</h2>

        <form method="POST" action="{{ route('producto.opciones') }}">
            @csrf
            <input type="hidden" name="tipo" value="{{ $tipo }}">

            @if ($tipo === 'cocina')
                <select name="subtipo">
                    <option value="">Selecciona el subtipo de cocina</option>
                    <option value="gas">A gas</option>
                    <option value="electrica">Eléctrica</option>
                </select>
            @elseif ($tipo === 'anafe')
                <select name="subtipo">
                    <option value="">Selecciona el subtipo de anafe</option>
                    <option value="2_hornallas">2 hornallas</option>
                    <option value="4_hornallas">4 hornallas</option>
                </select>
            @elseif ($tipo === 'calefactor')
                <select name="subtipo">
                    <option value="">Selecciona el subtipo de calefactor</option>
                    <option value="tiro_balanceado">Tiro balanceado</option>
                    <option value="camara_abierta">Cámara abierta</option>
                </select>
            @endif

            <br><br>
            <input type="submit" value="Siguiente">
        </form>
    @endif
</body>
</html>
