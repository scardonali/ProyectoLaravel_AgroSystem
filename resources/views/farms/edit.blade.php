@extends('adminlte::page')

@section('title', 'Editar Finca')

@section('content')

<div class="container-fluid">

    <div class="mb-4">
        <h2 class="fw-bold text-dark">Editar Finca</h2>
        <p class="text-muted">Modifica la información de la finca seleccionada</p>
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
            <h5 class="mb-0">Información de la Finca</h5>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('farms.update', $farm->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="name" class="form-label fw-semibold">Nombre</label>
                        <input type="text" class="form-control shadow-sm" id="name" name="name" value="{{ old('name', $farm->name) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="location" class="form-label fw-semibold">Ubicación</label>
                        <input type="text" class="form-control shadow-sm" id="location" name="location" value="{{ old('location', $farm->location) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="total_hectares" class="form-label fw-semibold">Total de hectáreas</label>
                        <input type="number" class="form-control shadow-sm" id="total_hectares" name="total_hectares" step="0.01" min="0" value="{{ old('total_hectares', $farm->total_hectares) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="user_id" class="form-label fw-semibold">Propietario</label>
                        <select name="user_id" id="user_id" class="form-select shadow-sm" required>
                            <option value="" disabled {{ old('user_id', $farm->user_id) ? '' : 'selected' }}>Seleccione un usuario</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id', $farm->user_id) == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-5">
                    <a href="{{ route('farms.index') }}" class="btn btn-outline-secondary px-4" style="margin-right: 15px;">Cancelar</a>
                    <button type="submit" class="btn btn-agro px-4">Actualizar Finca</button>
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
