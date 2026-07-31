@extends('adminlte::page')

@section('title', 'Roles')

@section('content')

<div class="container-fluid">

	<!-- Header -->
	<div class="d-flex justify-content-between align-items-center mb-4">
		<div>
			<h2 class="fw-bold text-dark">
				Gestion de Roles
			</h2>
			<p class="text-muted mb-0">Administra todos los roles registrados</p>
		</div>

		<a href="{{ route('roles.create') }}"
		   class="btn btn-agro px-4">
			Nuevo Rol
		</a>
	</div>

	<!-- Alertas -->
	@if(session('success'))
		<div class="alert alert-success shadow-sm">
			{{ session('success') }}
		</div>
	@endif

	@if(session('error'))
		<div class="alert alert-danger shadow-sm">
			{{ session('error') }}
		</div>
	@endif

	<!-- Card -->
	<div class="card shadow-lg border-0 rounded-4">

		<div class="card-header header-agro rounded-top-4">
			<h5 class="mb-0">Listado de Roles</h5>
		</div>

		<div class="card-body p-4">

			@if($roles->count())

				<div class="table-responsive">
					<table class="table table-hover align-middle">

						<thead class="table-light">
							<tr>
								<th>ID</th>
								<th>Nombre</th>
								<th>Descripcion</th>
								<th>Acciones</th>
							</tr>
						</thead>

						<tbody>
							@foreach($roles as $role)
								<tr>
									<td>{{ $role->id }}</td>
									<td>{{ $role->name }}</td>
									<td>{{ Str::limit($role->description, 70) }}</td>

									<td>
										<div class="d-flex gap-2">

											<a href="{{ route('roles.edit', $role->id) }}"
											   class="btn btn-outline-primary btn-sm">
												Editar
											</a>

											@if($role->id != 1)
											<form method="POST"
												  action="{{ route('roles.destroy', $role->id) }}"
												  onsubmit='return confirm(@json($role->users_count > 0 ? "Hay usuarios con este rol y volveran al rol basico. ¿Desea continuar?" : "¿Seguro que deseas eliminar este rol?"))'>
												@csrf
												@method('DELETE')

												<button type="submit"
														class="btn btn-outline-danger btn-sm">
													Eliminar
												</button>
											</form>
											@endif

										</div>
									</td>

								</tr>
							@endforeach
						</tbody>

					</table>
				</div>

			@else

				<div class="text-center py-5">
					<p class="text-muted mb-3">No hay roles registrados</p>

					<a href="{{ route('roles.create') }}"
					   class="btn btn-agro px-4">
						Crear primer rol
					</a>
				</div>

			@endif

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
