
@extends('adminlte::page')

@section('title', 'Insumos')

@section('content')

<div class="container-fluid">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold text-dark">
                Gestión de Insumos
            </h2>

            <p class="text-muted mb-0">
                Administra el inventario de insumos
            </p>
        </div>

        <a href="{{ route('supplies.create') }}"
           class="btn btn-agro px-4">

            Nuevo Insumo

        </a>

    </div>

    <!-- Alertas -->

    @if(session('success'))

        <div class="alert alert-success shadow-sm">
            {{ session('success') }}
        </div>

    @endif


    @if(session('error'))

        <div class="alert alert-danger shadow-sm">
            {{ session('error') }}
        </div>

    @endif



    <!-- GRÁFICA -->

    <div class="card shadow-lg border-0 rounded-4 mb-4">

        <div class="card-header header-agro rounded-top-4">

            <h5 class="mb-0">
                Distribución de Stock de Insumos
            </h5>

        </div>

        <div class="card-body">

            <div id="supplies-chart"></div>

        </div>

    </div>



    <!-- TABLA -->

    <div class="card shadow-lg border-0 rounded-4">

        <div class="card-header header-agro rounded-top-4">

            <h5 class="mb-0">
                Listado de Insumos
            </h5>

        </div>

        <div class="card-body p-4">

            @if($supplies->count())

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead class="table-light">

                            <tr>

                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Tipo</th>
                                <th>Unidad</th>
                                <th>Stock</th>
                                <th>Mínimo</th>
                                <th>Precio</th>
                                <th>Estado</th>
                                <th>Acciones</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($supplies as $supply)

                                <tr>

                                    <td>
                                        {{ $supply->id }}
                                    </td>

                                    <td class="fw-semibold">
                                        {{ $supply->name }}
                                    </td>

                                    <td>
                                        {{ $supply->type }}
                                    </td>

                                    <td>
                                        {{ $supply->unit_of_measure }}
                                    </td>

                                    <!-- Stock -->

                                    <td>

                                        <span class="fw-bold">
                                            {{ $supply->current_stock }}
                                        </span>

                                    </td>

                                    <!-- Mínimo -->

                                    <td>
                                        {{ $supply->minimum_stock }}
                                    </td>

                                    <!-- Precio -->

                                    <td>

                                        ${{ number_format($supply->unit_price, 2) }}

                                    </td>

                                    <!-- Estado -->

                                    <td>

                                        @if($supply->current_stock <= $supply->minimum_stock)

                                            <span class="badge bg-danger">

                                                Stock Bajo

                                            </span>

                                        @else

                                            <span class="badge bg-success">

                                                Stock OK

                                            </span>

                                        @endif

                                    </td>

                                    <!-- Acciones -->

                                    <td>

                                        <div class="d-flex gap-2">

                                            <a href="{{ route('supplies.edit', $supply->id) }}"
                                               class="btn btn-outline-primary btn-sm">

                                                Editar

                                            </a>

                                            <form
                                                action="{{ route('supplies.destroy', $supply->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('¿Seguro que deseas eliminar este insumo?')"
                                            >

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="btn btn-outline-danger btn-sm"
                                                >

                                                    Eliminar

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="text-center py-5">

                    <p class="text-muted mb-3">
                        No hay insumos registrados
                    </p>

                    <a href="{{ route('supplies.create') }}"
                       class="btn btn-agro px-4">

                        Crear primer insumo

                    </a>

                </div>

            @endif

        </div>

    </div>

</div>

@stop



@section('footer')

    <div class="text-center">

        AgroSystem © {{ date('Y') }}

    </div>

@stop



@section('css')

<link rel="stylesheet" href="{{ asset('css/custom.css') }}">

@endsection



@section('js')

<script>

    // =========================
    // DATOS MYSQL
    // =========================

    window.supplies = @json($supplies);

</script>


<script src="https://cdn.plot.ly/plotly-2.35.2.min.js"></script>


<script>

    // =========================
    // NOMBRES INSUMOS
    // =========================

    const supplyNames =
        window.supplies.map(
            supply => supply.name
        )


    // =========================
    // STOCK INSUMOS
    // =========================

    const supplyStock =
        window.supplies.map(
            supply => supply.current_stock
        )



    // =========================
    // GRÁFICA PLOTLY
    // =========================

    Plotly.newPlot(

        'supplies-chart',

        [{

            labels: supplyNames,

            values: supplyStock,

            type: 'pie'

        }],

        {

            title: 'Stock de Insumos'

        }

    )

</script>

@endsection
```
