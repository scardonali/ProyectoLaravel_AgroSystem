@extends('adminlte::page')

@section('title', 'Editar Rol')

@section('content')

<div class="container-fluid">

	<!-- Header -->
	<div class="mb-4">
		<h2 class="fw-bold text-dark">
			Editar Rol
		</h2>
		<p class="text-muted">Modifica la informacion del rol seleccionado</p>
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

	<!-- Card principal -->
	<div class="card shadow-lg border-0 rounded-4">

		<!-- Header Card -->
		<div class="card-header header-agro rounded-top-4">
			<h5 class="mb-0">Informacion del Rol</h5>
		</div>

		<!-- Body -->
		<div class="card-body p-4">

			<form action="{{ route('roles.update', $role->id) }}" method="POST">
				@csrf
				@method('PUT')

				<div class="row g-4">

					<div class="col-md-6">
						<label for="name" class="form-label fw-semibold">
							Nombre del Rol
						</label>
						<input type="text"
							   class="form-control shadow-sm"
							   id="name"
							   name="name"
							   value="{{ old('name', $role->name) }}"
							   required>
					</div>

					<div class="col-md-6">
						<label for="description" class="form-label fw-semibold">
							Descripcion
						</label>
						<input type="text"
							   class="form-control shadow-sm"
							   id="description"
							   name="description"
							   value="{{ old('description', $role->description) }}"
							   required>
					</div>

				</div>

				<!-- Botones -->
				<div class="d-flex justify-content-end mt-5">

					<a href="{{ route('roles.index') }}"
					   class="btn btn-outline-secondary px-4"
					   style="margin-right: 15px;">
						Cancelar
					</a>

					<button type="submit"
							class="btn btn-agro px-4">
						Actualizar Rol
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
