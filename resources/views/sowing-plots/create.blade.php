<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Siembra-Lote</title>
</head>
<body>
    <h1>Crear Nueva Siembra-Lote</h1>

    <form action="{{ route('sowings-plots.store') }}" method="POST">
        @csrf

        <div>
            <label for="sowing_id">Siembra</label>
            <select id="sowing_id" name="sowing_id" required>
                <option value="">Selecciona una siembra</option>
                @foreach($sowings as $sowing)
                    <option value="{{ $sowing->id }}">
                        Siembra #{{ $sowing->id }} - {{ $sowing->crop->type }}
                    </option>
                @endforeach
            </select>
            @error('sowing_id')<span style="color: red;">{{ $message }}</span>@enderror
        </div>

        <div>
            <label for="plot_id">Lote</label>
            <select id="plot_id" name="plot_id" required>
                <option value="">Selecciona un lote</option>
                @foreach($plots as $plot)
                    <option value="{{ $plot->id }}">
                        Lote #{{ $plot->id }}
                    </option>
                @endforeach
            </select>
            
        </div>

        <div>
            <label for="sown_quantity">Cantidad Sembrada</label>
            <input type="number" id="sown_quantity" name="sown_quantity" step="0.01" required>
            

        <div>
            <label for="unit">Unidad</label>
            <input type="text" id="unit" name="unit" required>
           
        </div>

        <div>
            <a href="{{ route('sowings-plots.index') }}">Cancelar</a>
            <button type="submit">Crear Siembra-Lote</button>
        </div>
    </form>
</body>
</html>
