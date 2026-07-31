<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siembras-Lotes</title>
</head>
<body>
    <h1>Gestión de Siembras-Lotes</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <a href="{{ route('sowings-plots.create') }}">Nueva Siembra-Lote</a>

    @if($sowingPlots->count())
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Siembra</th>
                    <th>Lote</th>
                    <th>Cantidad Sembrada</th>
                    <th>Unidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sowingPlots as $sp)
                    <tr>
                        <td>{{ $sp->id }}</td>
                        <td>Siembra #{{ $sp->sowing->id }} - {{ $sp->sowing->crop->type }}</td>
                        <td>Lote #{{ $sp->plot->id }}</td>
                        <td>{{ $sp->sown_quantity }}</td>
                        <td>{{ $sp->unit }}</td>
                        <td>
                            <a href="{{ route('sowings-plots.edit', $sp->id) }}">Editar</a>
                            <form action="{{ route('sowings-plots.destroy', $sp->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No hay siembras-lotes registradas. <a href="{{ route('sowings-plots.create') }}">Crea una nueva</a></p>
    @endif
</body>
</html>
