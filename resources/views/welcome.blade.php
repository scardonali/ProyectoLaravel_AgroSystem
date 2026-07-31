@extends('adminlte::page')

@section('title', 'Inicio')

@section('content')

<div class="container-fluid">

    <!-- HERO PRINCIPAL -->
    <div class="card border-0 rounded-4 shadow-lg mb-5 overflow-hidden"
         style="background: linear-gradient(135deg, #1b5e20, #00a708); color: white;">

        <div class="card-body p-5 text-center">

            <h1 class="fw-bold display-5 mb-3">
                Bienvenido a AgroSystem 
            </h1>

            <p class="lead mb-4">
                Tecnología que impulsa el crecimiento del campo
            </p>

            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <span class="badge bg-light text-success px-3 py-2">Gestión agrícola</span>
                <span class="badge bg-light text-success px-3 py-2">Productividad</span>
                <span class="badge bg-light text-success px-3 py-2">Innovación</span>
            </div>

        </div>
    </div>


    <!-- TARJETAS VISUALES -->
    <div class="row g-4">

        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm rounded-4 text-center p-4">

                <h5 class="fw-bold mb-2 text-success">Organiza</h5>

                <p class="text-muted mb-0">
                    Mantén toda la información agrícola estructurada y accesible.
                </p>

            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm rounded-4 text-center p-4">

                <h5 class="fw-bold mb-2 text-success">Controla</h5>

                <p class="text-muted mb-0">
                    Supervisa cada proceso con claridad y precisión.
                </p>

            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm rounded-4 text-center p-4">

                <h5 class="fw-bold mb-2 text-success">Optimiza</h5>

                <p class="text-muted mb-0">
                    Mejora la productividad y toma mejores decisiones.
                </p>

            </div>
        </div>

    </div>


    <!-- FRASE DESTACADA -->
    <div class="card border-0 shadow-lg rounded-4 mt-5 text-center">

        <div class="card-body p-5">

            <h4 class="fw-bold text-success mb-3">
                “El futuro del agro es digital”
            </h4>

            <p class="text-muted mb-0">
                AgroSystem está diseñado para acompañarte en cada etapa del proceso agrícola.
            </p>

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