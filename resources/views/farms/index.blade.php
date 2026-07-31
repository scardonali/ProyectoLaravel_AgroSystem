@extends('adminlte::page')

@section('title', 'Fincas')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark">Gestión de Fincas</h2>
            <p class="text-muted mb-0">Administra todas las fincas registradas</p>
        </div>

        <a href="{{ route('farms.create') }}" class="btn btn-agro px-4">Nueva Finca</a>
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
            <h5 class="mb-0">Listado de Fincas</h5>
        </div>

        <div class="card-body p-4">
            @if($farms->count())
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Propietario</th>
                                <th>Ubicación</th>
                                <th>Hectáreas</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($farms as $farm)
                                <tr>
                                    <td>{{ $farm->id }}</td>
                                    <td>{{ $farm->name }}</td>
                                    <td>{{ $farm->user?->name ?? 'Sin propietario' }}</td>
                                    <td>{{ $farm->location }}</td>
                                    <td>{{ $farm->total_hectares }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('farms.show', $farm->id) }}" class="btn btn-outline-secondary btn-sm">Ver</a>
                                            <a href="{{ route('farms.edit', $farm->id) }}" class="btn btn-outline-primary btn-sm">Editar</a>
                                            <form action="{{ route('farms.destroy', $farm->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar esta finca?')">
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
                    <p class="text-muted mb-3">No hay fincas registradas</p>
                    <a href="{{ route('farms.create') }}" class="btn btn-agro px-4">Crear primera finca</a>
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
