@extends('adminlte::page')

@section('title', 'Editar Lote')

@section('content')

<div class="container-fluid">

    <div class="mb-4">
        <h2 class="fw-bold text-dark">Editar Lote</h2>
        <p class="text-muted">Modifica la información del lote seleccionado</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger shadow-sm">
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header header-agro rounded-top-4">
            <h5 class="mb-0">Información del Lote</h5>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('plots.update', $plot->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="name" class="form-label fw-semibold">Nombre</label>
                        <input type="text" class="form-control shadow-sm" id="name" name="name" value="{{ old('name', $plot->name) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="area_hectares" class="form-label fw-semibold">Área en hectáreas</label>
                        <input type="number" class="form-control shadow-sm" id="area_hectares" name="area_hectares" step="0.01" min="0" value="{{ old('area_hectares', $plot->area_hectares) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="status" class="form-label fw-semibold">Estado</label>
                        <input type="text" class="form-control shadow-sm" id="status" name="status" value="{{ old('status', $plot->status) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="farm_id" class="form-label fw-semibold">Finca</label>
                        <select name="farm_id" id="farm_id" class="form-select shadow-sm" required>
                            <option value="" disabled {{ old('farm_id', $plot->farm_id) ? '' : 'selected' }}>Seleccione una finca</option>
                            @foreach ($farms as $farm)
                                <option value="{{ $farm->id }}" {{ old('farm_id', $plot->farm_id) == $farm->id ? 'selected' : '' }}>{{ $farm->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-5">
                    <a href="{{ route('plots.index') }}" class="btn btn-outline-secondary px-4" style="margin-right: 15px;">Cancelar</a>
                    <button type="submit" class="btn btn-agro px-4">Actualizar Lote</button>
                </div>
            </form>
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
