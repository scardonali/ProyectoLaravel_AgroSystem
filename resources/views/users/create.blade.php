@extends('adminlte::page')

@section('title', 'Crear Usuario')

@section('content')

<div class="container-fluid">
    <div class="mb-4">
        <h2 class="fw-bold text-dark mb-1">Registrar Nuevo Usuario</h2>
        <p class="text-muted mb-0">Crea usuarios con los datos básicos del sistema</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger shadow-sm">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header header-agro rounded-top-4">
            <h5 class="mb-0">Información del Usuario</h5>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                @if($reassign_from)
                    <input type="hidden" name="reassign_from" value="{{ $reassign_from }}">
                @endif

                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="name" class="form-label fw-semibold">Nombre</label>
                        <input type="text" class="form-control shadow-sm" id="name" name="name" value="{{ old('name') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <input type="email" class="form-control shadow-sm" id="email" name="email" value="{{ old('email') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="password" class="form-label fw-semibold">Contraseña</label>
                        <input type="password" class="form-control shadow-sm" id="password" name="password" required>
                    </div>

                    <div class="col-md-6">
                        <label for="role_id" class="form-label fw-semibold">Rol</label>
                        <select name="role_id" id="role_id" class="form-select shadow-sm">
                            <option value="" {{ old('role_id') ? '' : 'selected' }}>Rol base por defecto</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-5">
                    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary px-4" style="margin-right: 15px;">Cancelar</a>
                    <button type="submit" class="btn btn-agro px-4">Guardar Usuario</button>
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