@extends('adminlte::page')

@section('title', 'Siembras')

@section('content')

<div class="container-fluid">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark">
                Gestión de Siembras
            </h2>
            <p class="text-muted mb-0">Administra todas las siembras registradas</p>
        </div>

        <a href="{{ route('sowings.create') }}" 
           class="btn btn-agro px-4">
            Nueva Siembra
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
            <h5 class="mb-0">Listado de Siembras</h5>
        </div>

        <div class="card-body p-4">

            @if($sowings->count())

                <div class="table-responsive">
                    <table class="table table-hover align-middle">

                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Cultivo</th>
                                <th>Fecha de Siembra</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($sowings as $sowing)
                                <tr>
                                    <td>{{ $sowing->id }}</td>

                                    <td>
                                        {{ $sowing->crop->type }} - {{ $sowing->crop->variety }}
                                    </td>

                                    <td>{{ $sowing->sowing_date }}</td>

                                    <td>
                                        <span class="badge bg-secondary">
                                            {{ $sowing->status }}
                                        </span>
                                    </td>

                                    <td>
                                        <div class="d-flex gap-2">

                                            <a href="{{ route('sowings.edit', $sowing->id) }}" 
                                               class="btn btn-outline-primary btn-sm">
                                                Editar
                                            </a>
                                            <a href="{{ url('/reporte/gastos/' . $sowing->id) }}" 
                                            class="btn btn-outline-success btn-sm"
                                            target="_blank">
                                                📄 Reporte
                                            </a>

                                            <form action="{{ route('sowings.destroy', $sowing->id) }}" 
                                                  method="POST"
                                                  onsubmit="return confirm('¿Seguro que deseas eliminar esta siembra?')">
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
                    <p class="text-muted mb-3">No hay siembras registradas</p>

                    <a href="{{ route('sowings.create') }}" 
                       class="btn btn-agro px-4">
                        Crear primera siembra
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