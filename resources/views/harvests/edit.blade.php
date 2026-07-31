@extends('adminlte::page')

@section('title', 'Editar Cosecha')

@section('content')

<div class="container-fluid">

    <!-- Header -->
    <div class="mb-4">
        <h2 class="fw-bold text-dark">
            Editar Cosecha
        </h2>
        <p class="text-muted">Modifica la información de la cosecha</p>
    </div>

    <!-- Card -->
    <div class="card shadow-lg border-0 rounded-4">

        <!-- Header -->
        <div class="card-header header-agro rounded-top-4">
            <h5 class="mb-0">Información de la Cosecha</h5>
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

            <form action="{{ route('harvests.update', $harvest->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-4">

                    <!-- Siembra -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Siembra</label>

                        <select name="sowing_id" class="form-control shadow-sm" required>

                            @foreach($sowings as $sowing)
                                <option value="{{ $sowing->id }}"
                                    {{ old('sowing_id', $harvest->sowing_id) == $sowing->id ? 'selected' : '' }}>

                                    {{ $sowing->crop->type ?? 'Sin cultivo' }}
                                    {{ $sowing->crop->variety ? '- '.$sowing->crop->variety : '' }}
                                    | Lote(s):
                                    @forelse($sowing->sowingsPlots as $sp)
                                        {{ $sp->plot->name ?? 'Sin lote' }}{{ !$loop->last ? ', ' : '' }}
                                    @empty
                                        Sin lote
                                    @endforelse

                                </option>
                            @endforeach

                        </select>

                        @error('sowing_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Cantidad -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Cantidad</label>

                        <input type="number" 
                               name="quantity" 
                               class="form-control shadow-sm"
                               value="{{ old('quantity', $harvest->quantity) }}"
                               required>

                        @error('quantity')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Unidad -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Unidad</label>

                        <input type="text" 
                               name="unit" 
                               class="form-control shadow-sm"
                               value="{{ old('unit', $harvest->unit) }}"
                               required>

                        @error('unit')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Precio -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Precio de Venta</label>

                        <input type="number" 
                               step="0.01"
                               name="sale_price" 
                               class="form-control shadow-sm"
                               value="{{ old('sale_price', $harvest->sale_price) }}"
                               required>

                        @error('sale_price')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Fecha -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Fecha</label>

                        <input type="date" 
                               name="date" 
                               class="form-control shadow-sm"
                               value="{{ old('date', $harvest->date) }}"
                               required>

                        @error('date')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

                <!-- Botones -->
                <div class="d-flex justify-content-end mt-5">

                    <a href="{{ route('harvests.index') }}" 
                       class="btn btn-outline-secondary px-4"
                       style="margin-right: 15px;">
                        Cancelar
                    </a>

                    <button type="submit" 
                            class="btn btn-agro px-4">
                        Actualizar Cosecha
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