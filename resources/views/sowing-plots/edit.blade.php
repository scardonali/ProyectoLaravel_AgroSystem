<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Siembra-Lote</title>
</head>
<body>
    <h1>Editar Siembra-Lote</h1>

    <form action="{{ route('sowings-plots.update', $sowingPlot->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="sowing_id">Siembra</label>
            <select id="sowing_id" name="sowing_id" required>
                <option value="">Selecciona una siembra</option>
                @foreach($sowings as $sowing)
                    <option value="{{ $sowing->id }}" {{ $sowingPlot->sowing_id == $sowing->id ? 'selected' : '' }}>
                        Siembra #{{ $sowing->id }} - {{ $sowing->crop->type }}
                    </option>
                @endforeach
            </select>
            
        </div>

        <div>
            <label for="plot_id">Lote</label>
            <select id="plot_id" name="plot_id" required>
                <option value="">Selecciona un lote</option>
                @foreach($plots as $plot)
                    <option value="{{ $plot->id }}" {{ $sowingPlot->plot_id == $plot->id ? 'selected' : '' }}>
                        Lote #{{ $plot->id }}
                    </option>
                @endforeach
            </select>
            
        </div>

        <div>
            <label for="sown_quantity">Cantidad Sembrada</label>
            <input type="number" id="sown_quantity" name="sown_quantity" step="0.01" value="{{ $sowingPlot->sown_quantity }}" required>
            
        </div>

        <div>
            <label for="unit">Unidad</label>
            <input type="text" id="unit" name="unit" value="{{ $sowingPlot->unit }}" required>
            

        <div>
            <a href="{{ route('sowings-plots.index') }}">Cancelar</a>
            <button type="submit">Actualizar Siembra-Lote</button>
        </div>
    </form>
</body>
</html>
