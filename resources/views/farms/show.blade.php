@extends('adminlte::page')

@section('title', 'Detalle Finca')

@section('content')

<div class="container-fluid">

    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h2 class="fw-bold text-dark">Detalle de Finca</h2>
            <p class="text-muted mb-0">Información general y lotes asociados</p>
        </div>

        <a href="{{ route('farms.index') }}" class="btn btn-outline-secondary">Volver</a>
    </div>

    <div class="card shadow-lg border-0 rounded-4 mb-4">
        <div class="card-header header-agro rounded-top-4">
            <h5 class="mb-0">Información General</h5>
        </div>

        <div class="card-body p-4">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded-3">
                        <strong>Nombre:</strong> {{ $farm->name }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded-3">
                        <strong>Propietario:</strong> {{ $farm->user?->name ?? 'Sin propietario' }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded-3">
                        <strong>Ubicación:</strong> {{ $farm->location }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded-3">
                        <strong>Hectáreas:</strong> {{ $farm->total_hectares }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header header-agro rounded-top-4">
            <h5 class="mb-0">Lotes Asociados ({{ $farm->plots->count() }})</h5>
        </div>

        <div class="card-body p-4">
            @if($farm->plots->count())
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Área (ha)</th>
                                <th>Estado</th>
                                <th>Siembras</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($farm->plots as $plot)
                                <tr>
                                    <td>{{ $plot->id }}</td>
                                    <td>{{ $plot->name }}</td>
                                    <td>{{ $plot->area_hectares }}</td>
                                    <td>{{ $plot->status }}</td>
                                    <td>
                                        @forelse($plot->sowingsPlots as $sp)
                                            <div>{{ $sp->sowing->crop->type ?? 'Sin cultivo' }}</div>
                                        @empty
                                            <span class="text-muted">No hay cultivos</span>
                                        @endforelse
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <p class="text-muted mb-0">No hay lotes asociados a esta finca</p>
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
