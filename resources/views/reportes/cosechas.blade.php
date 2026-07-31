<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Cosecha</title>
</head>

<body style="font-family: Arial, sans-serif; font-size: 13px;">

<h2 style="text-align:center;">
    🌾 REPORTE DE COSECHA
</h2>

<hr>

<!-- INFO PRINCIPAL -->
<p><strong>ID Cosecha:</strong> {{ $harvest->id }}</p>

<p><strong>Cultivo:</strong>
    {{ $harvest->sowing->crop->type ?? '' }}
    {{ $harvest->sowing->crop->variety ?? '' }}
</p>

<p><strong>Fecha:</strong> {{ $harvest->date }}</p>

<hr>

<!-- DETALLE -->
<table border="1" width="100%" cellpadding="6">

    <tr>
        <th>Cantidad</th>
        <th>Unidad</th>
        <th>Precio Unitario</th>
        <th>Total</th>
    </tr>

    <tr>
        <td>{{ $harvest->quantity }}</td>
        <td>{{ $harvest->unit }}</td>
        <td>${{ number_format($harvest->sale_price, 0, ',', '.') }}</td>
        <td>
            <strong>
                ${{ number_format($total, 0, ',', '.') }}
            </strong>
        </td>
    </tr>

</table>

<hr>

<h3 style="text-align:right;">
    Ganancia: ${{ number_format($total, 0, ',', '.') }}
</h3>

<p style="text-align:center; font-size:10px;">
    Reporte generado automáticamente por el sistema agrícola
</p>

</body>
</html>