!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Gastos</title>
</head>

<body style="font-family: Arial, sans-serif; font-size: 12px;">

<!-- ENCABEZADO -->
<h2 style="text-align:center; margin-bottom:5px;">
    REPORTE DE GASTOS POR SIEMBRA
</h2>

<hr>

<!-- INFORMACIÓN DE LA SIEMBRA -->
<div style="margin-bottom:15px;">

    <p><strong>ID Siembra:</strong> {{ $sowing->id }}</p>

    <p><strong>Cultivo:</strong>
        {{ $sowing->crop->type ?? '' }} - {{ $sowing->crop->variety ?? '' }}
    </p>

    <p><strong>Fecha de siembra:</strong> {{ $sowing->sowing_date }}</p>

    <p><strong>Estado:</strong> {{ $sowing->status }}</p>

</div>

<hr>

<!-- TABLA DE GASTOS -->
<table border="1" width="100%" cellpadding="6" cellspacing="0">

    <thead>
        <tr style="background-color:#f2f2f2;">
            <th>Insumo</th>
            <th>Cantidad</th>
            <th>Costo</th>
            <th>Fecha</th>
        </tr>
    </thead>

    <tbody>
        @foreach($sowing->expenses as $expense)
            <tr>
                <td>{{ $expense->supply->name ?? 'N/A' }}</td>
                <td>{{ $expense->quantity_used }}</td>
                <td>
                    ${{ number_format($expense->total_cost, 0, ',', '.') }}
                </td>
                <td>{{ $expense->date }}</td>
            </tr>
        @endforeach
    </tbody>

</table>

<!-- TOTAL -->
<h3 style="text-align:right; margin-top:20px;">
     Total Gastos: ${{ number_format($total, 0, ',', '.') }}
</h3>

<!-- PIE DE PÁGINA -->
<hr>

<p style="text-align:center; font-size:10px;">
    Reporte generado automáticamente por el sistema agrícola
</p>

</body>
</html>