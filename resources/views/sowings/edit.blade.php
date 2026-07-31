@extends('adminlte::page')

@section('title', 'Editar Siembra')

@section('content')

<div class="container-fluid">

    <!-- Header -->
    <div class="mb-4">
        <h2 class="fw-bold text-dark">
            Editar Siembra
        </h2>
        <p class="text-muted">Modifica la información de la siembra</p>
    </div>

    <!-- Card -->
    <div class="card shadow-lg border-0 rounded-4">

        <!-- Header Card -->
        <div class="card-header header-agro rounded-top-4">
            <h5 class="mb-0">Información de la Siembra</h5>
        </div>

        <!-- Body -->
        <div class="card-body p-4">

            <form action="{{ route('sowings.update', $sowing->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-4">

                    <!-- Cultivo -->
                    <div class="col-md-6">
                        <label for="crop_id" class="form-label fw-semibold">
                            Cultivo
                        </label>

                        <select id="crop_id" 
                                name="crop_id" 
                                class="form-control shadow-sm" 
                                required>

                            <option value="">Selecciona un cultivo</option>

                            @foreach($crops as $crop)
                                <option value="{{ $crop->id }}"
                                    {{ old('crop_id', $sowing->crop_id) == $crop->id ? 'selected' : '' }}>
                                    {{ $crop->type }} - {{ $crop->variety }}
                                </option>
                            @endforeach

                        </select>

                        @error('crop_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Fecha -->
                    <div class="col-md-6">
                        <label for="sowing_date" class="form-label fw-semibold">
                            Fecha de Siembra
                        </label>

                        <input type="date" 
                               id="sowing_date" 
                               name="sowing_date" 
                               class="form-control shadow-sm"
                               value="{{ old('sowing_date', $sowing->sowing_date) }}"
                               required>

                        @error('sowing_date')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Estado -->
                    <div class="col-md-6">
                        <label for="status" class="form-label fw-semibold">
                            Estado
                        </label>

                        <select id="status" 
                                name="status" 
                                class="form-control shadow-sm"
                                required>

                            <option value="">Selecciona estado</option>
                            <option value="pendiente" {{ old('status', $sowing->status) == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option value="en_proceso" {{ old('status', $sowing->status) == 'en_proceso' ? 'selected' : '' }}>En proceso</option>
                            <option value="finalizado" {{ old('status', $sowing->status) == 'finalizado' ? 'selected' : '' }}>Finalizado</option>

                        </select>

                        @error('status')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

                <!-- Botones -->
                <div class="d-flex justify-content-end mt-5">

                    <a href="{{ route('sowings.index') }}" 
                       class="btn btn-outline-secondary px-4"
                       style="margin-right: 15px;">
                        Cancelar
                    </a>

                    <button type="submit" 
                            class="btn btn-agro px-4">
                        Actualizar Siembra
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