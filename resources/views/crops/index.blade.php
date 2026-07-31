@extends('adminlte::page')

@section('title', 'Cultivos')

@section('content')

<div class="container-fluid">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark">
                Gestión de Cultivos
            </h2>
            <p class="text-muted mb-0">Administra todos los cultivos registrados</p>
        </div>

        <a href="{{ route('crops.create') }}" 
           class="btn btn-agro px-4">
            Nuevo Cultivo
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
            <h5 class="mb-0">Listado de Cultivos</h5>
        </div>

        <div class="card-body p-4">

            @if($crops->count())

                <div class="table-responsive">
                    <table class="table table-hover align-middle">

                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Tipo</th>
                                <th>Variedad</th>
                                <th>Descripción</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($crops as $crop)
                                <tr>
                                    <td>{{ $crop->id }}</td>
                                    <td>{{ $crop->type }}</td>
                                    <td>{{ $crop->variety }}</td>
                                    <td>{{ Str::limit($crop->description, 50) }}</td>

                                    <td>
                                        <div class="d-flex gap-2">

                                            <a href="{{ route('crops.edit', $crop->id) }}" 
                                               class="btn btn-outline-primary btn-sm">
                                                Editar
                                            </a>

                                            <form method="POST" 
                                                  action="{{ route('crops.destroy', $crop->id) }}" 
                                                  onsubmit="return confirm('¿Seguro que deseas eliminar este cultivo?')">
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
                    <p class="text-muted mb-3">No hay cultivos registrados</p>

                    <a href="{{ route('crops.create') }}" 
                       class="btn btn-agro px-4">
                        Crear primer cultivo
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