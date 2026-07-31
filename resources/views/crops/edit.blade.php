@extends('adminlte::page')

@section('title', 'Editar Cultivo')

@section('content')

<div class="container-fluid">

    <!-- Header -->
    <div class="mb-4">
        <h2 class="fw-bold text-dark">
            Editar Cultivo
        </h2>
        <p class="text-muted">Modifica la información del cultivo seleccionado</p>
    </div>

    <!-- Card principal -->
    <div class="card shadow-lg border-0 rounded-4">

        <!-- Header Card -->
        <div class="card-header header-agro rounded-top-4">
            <h5 class="mb-0">Información del Cultivo</h5>
        </div>

        <!-- Body -->
        <div class="card-body p-4">

            <form action="{{ route('crops.update', $crop->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-4">

                    <!-- Tipo -->
                    <div class="col-md-6">
                        <label for="type" class="form-label fw-semibold">
                            Tipo de Cultivo
                        </label>
                        <input type="text" 
                               class="form-control shadow-sm" 
                               id="type" 
                               name="type" 
                               value="{{ old('type', $crop->type) }}"
                               required>
                    </div>

                    <!-- Variedad -->
                    <div class="col-md-6">
                        <label for="variety" class="form-label fw-semibold">
                            Variedad
                        </label>
                        <input type="text" 
                               class="form-control shadow-sm" 
                               id="variety" 
                               name="variety" 
                               value="{{ old('variety', $crop->variety) }}"
                               required>
                    </div>

                    <!-- Descripción -->
                    <div class="col-12">
                        <label for="description" class="form-label fw-semibold">
                            Descripción
                        </label>
                        <textarea 
                            class="form-control shadow-sm" 
                            id="description" 
                            name="description" 
                            rows="4"
                            required>{{ old('description', $crop->description) }}</textarea>
                    </div>

                </div>

                <!-- Botones -->
                <div class="d-flex justify-content-end mt-5">

                    <a href="{{ route('crops.index') }}" 
                       class="btn btn-outline-secondary px-4"
                       style="margin-right: 15px;">
                        Cancelar
                    </a>

                    <button type="submit" 
                            class="btn btn-agro px-4">
                        Actualizar Cultivo
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