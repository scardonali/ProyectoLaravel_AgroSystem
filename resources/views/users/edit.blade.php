@extends('adminlte::page')

@section('title', 'Editar Usuario')

@section('content')

<div class="container-fluid">
    <div class="mb-4">
        <h2 class="fw-bold text-dark mb-1">Editar Usuario {{ $user->id }}</h2>
        <p class="text-muted mb-0">Modifica la información del usuario seleccionado</p>
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
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="name" class="form-label fw-semibold">Nombre</label>
                        <input type="text" class="form-control shadow-sm" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <input type="email" class="form-control shadow-sm" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="role_id" class="form-label fw-semibold">Rol</label>
                        <select name="role_id" id="role_id" class="form-select shadow-sm" required>
                            <option value="" disabled {{ is_null($user->role_id) ? 'selected' : '' }}>Seleccione un rol</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-5">
                    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary px-4" style="margin-right: 15px;">Cancelar</a>
                    <button type="submit" class="btn btn-agro px-4">Actualizar Usuario</button>
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