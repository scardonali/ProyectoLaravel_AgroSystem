@extends('adminlte::page')

@section('title', 'Lotes')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark">Gestión de Lotes</h2>
            <p class="text-muted mb-0">Administra todos los lotes registrados</p>
        </div>

        <a href="{{ route('plots.create') }}" class="btn btn-agro px-4">Nuevo Lote</a>
    </div>

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

    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header header-agro rounded-top-4">
            <h5 class="mb-0">Listado de Lotes</h5>
        </div>

        <div class="card-body p-4">
            @if($plots->count())
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Finca</th>
                                <th>Área (ha)</th>
                                <th>Estado</th>
                                <th>Siembras</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($plots as $plot)
                                <tr>
                                    <td>{{ $plot->id }}</td>
                                    <td>{{ $plot->name }}</td>
                                    <td>{{ $plot->farm?->name ?? 'Sin finca' }}</td>
                                    <td>{{ $plot->area_hectares }}</td>
                                    <td>{{ $plot->status }}</td>
                                    <td>{{ $plot->sowings_plots_count }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('plots.edit', $plot->id) }}" class="btn btn-outline-primary btn-sm">Editar</a>
                                            <form action="{{ route('plots.destroy', $plot->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este lote?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm">Eliminar</button>
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
                    <p class="text-muted mb-3">No hay lotes registrados</p>
                    <a href="{{ route('plots.create') }}" class="btn btn-agro px-4">Crear primer lote</a>
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
