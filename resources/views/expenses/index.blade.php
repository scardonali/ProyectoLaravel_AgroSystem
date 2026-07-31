@extends('adminlte::page')

@section('title', 'Gastos')

@section('content')

<div class="container-fluid">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark">
                Gestión de Gastos
            </h2>
            <p class="text-muted mb-0">Administra los gastos de las siembras</p>
        </div>

        <a href="{{ route('expenses.create') }}" 
           class="btn btn-agro px-4">
            Nuevo Gasto
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

    <!-- Card -->
    <div class="card shadow-lg border-0 rounded-4">

        <div class="card-header header-agro rounded-top-4">
            <h5 class="mb-0">Listado de Gastos</h5>
        </div>

        <div class="card-body p-4">

            @if($expenses->count())

                <div class="table-responsive">
                    <table class="table table-hover align-middle">

                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Siembra</th>
                                <th>Insumo</th>
                                <th>Cantidad</th>
                                <th>Costo</th>
                                <th>Fecha</th>
                                <th>Descripción</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($expenses as $expense)
                                <tr>

                                    <td>{{ $expense->id }}</td>

                                    <td>
                                        <strong>
                                            {{ $expense->sowing->crop->type ?? 'Sin cultivo' }}
                                        </strong>
                                        {{ $expense->sowing->crop->variety ? '- '.$expense->sowing->crop->variety : '' }}
                                        <br>
                                        <small class="text-muted">
                                            Lote(s):
                                            @forelse($expense->sowing->sowingsPlots ?? [] as $sowingPlot)
                                                {{ $sowingPlot->plot->name ?? 'Sin lote' }}{{ !$loop->last ? ', ' : '' }}
                                            @empty
                                                Sin lote
                                            @endforelse
                                        </small>
                                    </td>

                                    <td>{{ $expense->supply->name ?? 'Sin insumo' }}</td>

                                    <td>{{ $expense->quantity_used }}</td>

                                    <td>
                                        <span class="fw-semibold text-success">
                                            ${{ number_format($expense->total_cost, 2) }}
                                        </span>
                                    </td>

                                    <td>{{ $expense->date }}</td>

                                    <td>{{ Str::limit($expense->description, 40) }}</td>

                                    <td>
                                        <div class="d-flex gap-2">

                                            <a href="{{ route('expenses.edit', $expense->id) }}" 
                                               class="btn btn-outline-primary btn-sm">
                                                Editar
                                            </a>

                                            <form action="{{ route('expenses.destroy', $expense->id) }}" 
                                                  method="POST"
                                                  onsubmit="return confirm('¿Eliminar este gasto?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" 
                                                        class="btn btn-outline-danger btn-sm">
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
                    <p class="text-muted mb-3">No hay gastos registrados</p>

                    <a href="{{ route('expenses.create') }}" 
                       class="btn btn-agro px-4">
                        Crear primer gasto
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