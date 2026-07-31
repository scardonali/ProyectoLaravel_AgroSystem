
@extends('adminlte::page')

@section('title', 'Cosechas')

@section('content')

<div class="container-fluid">

    <!-- Header -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold text-dark">
                Gestión de Cosechas
            </h2>

            <p class="text-muted mb-0">
                Administra la producción obtenida
            </p>

        </div>

        <a href="{{ route('harvests.create') }}"
           class="btn btn-agro px-4">

            Nueva Cosecha

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
                Gastos vs Ganancias de Cosechas
            </h5>

        </div>

        <div class="card-body">

            <div id="harvest-chart"></div>

        </div>

    </div>



    <!-- TABLA -->

    <div class="card shadow-lg border-0 rounded-4">

        <div class="card-header header-agro rounded-top-4">

            <h5 class="mb-0">
                Listado de Cosechas
            </h5>

        </div>

        <div class="card-body p-4">

            @if($harvests->count())

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead class="table-light">

                            <tr>

                                <th>ID</th>
                                <th>Siembra</th>
                                <th>Cantidad</th>
                                <th>Unidad</th>
                                <th>Precio</th>
                                <th>Ganancia</th>
                                <th>Fecha</th>
                                <th>Acciones</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($harvests as $harvest)

                                <tr>

                                    <td>
                                        {{ $harvest->id }}
                                    </td>

                                    <td>

                                        <strong>

                                            {{ $harvest->sowing->crop->type ?? 'Sin cultivo' }}

                                        </strong>

                                        {{ $harvest->sowing->crop->variety ? '- '.$harvest->sowing->crop->variety : '' }}

                                        <br>

                                        <small class="text-muted">

                                            Lote(s):

                                            @forelse($harvest->sowing->sowingsPlots ?? [] as $sp)

                                                {{ $sp->plot->name ?? 'Sin lote' }}{{ !$loop->last ? ', ' : '' }}

                                            @empty

                                                Sin lote

                                            @endforelse

                                        </small>

                                    </td>

                                    <td>
                                        {{ $harvest->quantity }}
                                    </td>

                                    <td>
                                        {{ $harvest->unit }}
                                    </td>

                                    <td>

                                        ${{ number_format($harvest->sale_price, 2) }}

                                    </td>

                                    <!-- Ganancia -->

                                    <td>

                                        <span class="fw-semibold text-success">

                                            ${{ number_format($harvest->quantity * $harvest->sale_price, 2) }}

                                        </span>

                                    </td>

                                    <td>
                                        {{ $harvest->date }}
                                    </td>

                                    <td>

                                        <div class="d-flex gap-2">

                                            <a href="{{ route('harvests.edit', $harvest->id) }}"
                                               class="btn btn-outline-primary btn-sm">

                                                Editar

                                            </a>

                                            <form
                                                action="{{ route('harvests.destroy', $harvest->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('¿Eliminar esta cosecha?')"
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

                                            <a
                                                href="{{ url('/reporte/cosecha/' . $harvest->id) }}"
                                                class="btn btn-outline-success btn-sm"
                                                target="_blank"
                                            >

                                                📄 PDF

                                            </a>

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
                        No hay cosechas registradas
                    </p>

                    <a href="{{ route('harvests.create') }}"
                       class="btn btn-agro px-4">

                        Crear primera cosecha

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

    window.expenses = {{ $expenses }};

    window.harvestProfit = {{ $harvestProfit }};

</script>


<script src="https://cdn.plot.ly/plotly-2.35.2.min.js"></script>


<script>

    // =========================
    // PLOTLY
    // =========================

    Plotly.newPlot(

        'harvest-chart',

        [{

            x: ['Gastos', 'Ganancias'],

            y: [
                window.expenses,
                window.harvestProfit
            ],

            type: 'bar'

        }],

        {

            title: 'Comparación Financiera'

        }

    )

</script>

@endsection
```
