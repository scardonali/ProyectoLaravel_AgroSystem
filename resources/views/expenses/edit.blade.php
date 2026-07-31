@extends('adminlte::page')

@section('title', 'Editar Gasto')

@section('content')

<div class="container-fluid">

    <!-- Header -->
    <div class="mb-4">
        <h2 class="fw-bold text-dark">
            Editar Gasto
        </h2>
        <p class="text-muted">Modifica la información del gasto registrado</p>
    </div>

    <!-- Card -->
    <div class="card shadow-lg border-0 rounded-4">

        <!-- Header -->
        <div class="card-header header-agro rounded-top-4">
            <h5 class="mb-0">Información del Gasto</h5>
        </div>

        <!-- Body -->
        <div class="card-body p-4">

            <form action="{{ route('expenses.update', $expense->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-4">

                    <!-- Siembra -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Siembra</label>

                        <select name="sowing_id" class="form-control shadow-sm" required>
                            <option value="">Seleccione una siembra</option>

                            @foreach($sowings as $sowing)
                                <option value="{{ $sowing->id }}"
                                    {{ old('sowing_id', $expense->sowing_id) == $sowing->id ? 'selected' : '' }}>

                                    Cultivo: {{ $sowing->crop->type ?? 'Sin cultivo' }}
                                    {{ $sowing->crop->variety ? '- '.$sowing->crop->variety : '' }}
                                    | Lote(s):
                                    @forelse($sowing->sowingsPlots as $sowingPlot)
                                        {{ $sowingPlot->plot->name ?? 'Sin lote' }}{{ !$loop->last ? ', ' : '' }}
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

                    <!-- Insumo -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Insumo</label>

                        <select name="supply_id" class="form-control shadow-sm" required>
                            <option value="">Seleccione un insumo</option>

                            @foreach($supplies as $supply)
                                <option value="{{ $supply->id }}"
                                    {{ old('supply_id', $expense->supply_id) == $supply->id ? 'selected' : '' }}>
                                    {{ $supply->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('supply_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Cantidad -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Cantidad Usada</label>

                        <input type="number" 
                               name="quantity_used" 
                               class="form-control shadow-sm"
                               value="{{ old('quantity_used', $expense->quantity_used) }}"
                               required>

                        @error('quantity_used')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Costo -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Costo Total</label>

                        <input type="number" 
                               step="0.01"
                               name="total_cost" 
                               class="form-control shadow-sm"
                               value="{{ old('total_cost', $expense->total_cost) }}"
                               required>

                        @error('total_cost')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Fecha -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Fecha</label>

                        <input type="date" 
                               name="date" 
                               class="form-control shadow-sm"
                               value="{{ old('date', $expense->date) }}"
                               required>

                        @error('date')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Descripción -->
                    <div class="col-12">
                        <label class="form-label fw-semibold">Descripción</label>

                        <textarea name="description" 
                                  class="form-control shadow-sm"
                                  rows="3" required>{{ old('description', $expense->description) }}</textarea>

                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

                <!-- Botones -->
                <div class="d-flex justify-content-end mt-5">

                    <a href="{{ route('expenses.index') }}" 
                       class="btn btn-outline-secondary px-4"
                       style="margin-right: 15px;">
                        Cancelar
                    </a>

                    <button type="submit" 
                            class="btn btn-agro px-4">
                        Actualizar Gasto
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