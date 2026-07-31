@extends('adminlte::page')

@section('title', 'Editar Insumo')

@section('content')

<div class="container-fluid">

    <!-- Header -->
    <div class="mb-4">
        <h2 class="fw-bold text-dark">
            Editar Insumo
        </h2>
        <p class="text-muted">Modifica la información del insumo</p>
    </div>

    <!-- Card -->
    <div class="card shadow-lg border-0 rounded-4">

        <!-- Header -->
        <div class="card-header header-agro rounded-top-4">
            <h5 class="mb-0">Información del Insumo</h5>
        </div>

        <!-- Body -->
        <div class="card-body p-4">

            <!-- Errores -->
            @if ($errors->any())
                <div class="alert alert-danger shadow-sm">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('supplies.update', $supply->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-4">

                    <!-- Nombre -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nombre</label>

                        <input type="text" 
                               name="name" 
                               class="form-control shadow-sm"
                               value="{{ old('name', $supply->name) }}"
                               required>

                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Tipo -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Tipo</label>

                        <input type="text" 
                               name="type" 
                               class="form-control shadow-sm"
                               value="{{ old('type', $supply->type) }}"
                               required>

                        @error('type')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Unidad -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Unidad de Medida</label>

                        <input type="text" 
                               name="unit_of_measure" 
                               class="form-control shadow-sm"
                               value="{{ old('unit_of_measure', $supply->unit_of_measure) }}"
                               required>

                        @error('unit_of_measure')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Stock Actual -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Stock Actual</label>

                        <input type="number" 
                               name="current_stock" 
                               class="form-control shadow-sm"
                               value="{{ old('current_stock', $supply->current_stock) }}"
                               required>

                        @error('current_stock')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Stock Mínimo -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Stock Mínimo</label>

                        <input type="number" 
                               name="minimum_stock" 
                               class="form-control shadow-sm"
                               value="{{ old('minimum_stock', $supply->minimum_stock) }}"
                               required>

                        @error('minimum_stock')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Precio -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Precio Unitario</label>

                        <input type="number" 
                               step="0.01"
                               name="unit_price" 
                               class="form-control shadow-sm"
                               value="{{ old('unit_price', $supply->unit_price) }}"
                               required>

                        @error('unit_price')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

                <!-- Botones -->
                <div class="d-flex justify-content-end mt-5">

                    <a href="{{ route('supplies.index') }}" 
                       class="btn btn-outline-secondary px-4"
                       style="margin-right: 15px;">
                        Cancelar
                    </a>

                    <button type="submit" 
                            class="btn btn-agro px-4">
                        Actualizar Insumo
                    </button>

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