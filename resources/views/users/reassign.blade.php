@extends('adminlte::page')

@section('title', 'Reasignar Fincas')

@section('content')

<div class="container-fluid">
	<div class="mb-4">
		<h2 class="fw-bold text-dark mb-1">Eliminar Usuario: {{ $user->name }}</h2>
		<p class="text-muted mb-0">Este usuario tiene fincas que necesitan reasignarse</p>
	</div>

	<div class="card shadow-lg border-0 rounded-4">
		<div class="card-header header-agro rounded-top-4">
			<h5 class="mb-0">Fincas a reasignar</h5>
		</div>

		<div class="card-body p-4">
			<div class="alert alert-info">
				<strong>{{ $farms->count() }} finca(s)</strong> serán reasignadas:
			</div>

			<ul class="list-group mb-4">
				@foreach($farms as $farm)
					<li class="list-group-item">
						<strong>{{ $farm->name }}</strong> — {{ $farm->location }}
						<span class="badge bg-secondary float-end">{{ $farm->area_hectares }} ha</span>
					</li>
				@endforeach
			</ul>

			<hr>

			<h5>Opción 1: Reasignar a usuario existente</h5>
			<form id="reassignForm" method="POST" class="mb-4">
				@csrf
				@method('PUT')
				<input type="hidden" name="reassign_from" value="{{ $user->id }}">
				<div class="row">
					<div class="col-md-6">
						<select name="assign_to" id="assign_to" class="form-select" onchange="submitReassignForm(this.value)">
							<option value="">Selecciona un usuario destino</option>
							@foreach($existingUsers as $u)
								<option value="{{ $u->id }}">{{ $u->name }} ({{ $u->email }})</option>
							@endforeach
						</select>
					</div>
				</div>
			</form>

			<hr>

			<h5>Opción 2: Crear nuevo usuario y reasignar</h5>
			<p class="text-muted mb-3">Crea un nuevo usuario para asignarle estas fincas automáticamente</p>
			<a href="{{ route('users.create', ['reassign_from' => $user->id]) }}" class="btn btn-primary">
				Crear nuevo usuario
			</a>

			<hr>
		</div>
	</div>
</div>

<script>
function submitReassignForm(userId) {
	if(userId) {
		const form = document.getElementById('reassignForm');
		form.action = '/users/' + userId;
		form.submit();
	}
}

</script>

@stop
@section('footer')
    <div class="text-center">
        AgroSystem © {{ date('Y') }}
    </div>
@stop
@section('css')
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endsection
