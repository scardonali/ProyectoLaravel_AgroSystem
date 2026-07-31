@extends('adminlte::page')

@section('title', 'Clima de la Finca')

@section('content')

<div class="container-fluid">

    <!-- HEADER -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold text-dark">
                Dashboard Climático
            </h2>

            <p class="text-muted mb-0">
                Monitorea el clima y pronóstico de la finca
            </p>

        </div>

    </div>



    <!-- CLIMA ACTUAL -->

    <div class="card shadow-lg border-0 rounded-4 mb-4">

        <div class="card-header header-agro rounded-top-4">

            <h5 class="mb-0">
                Clima Actual
            </h5>

        </div>

        <div class="card-body">

            <div id="weather-container">

                <div class="text-center py-4">

                    <p class="text-muted">
                        Cargando clima...
                    </p>

                </div>

            </div>

        </div>

    </div>



    <!-- PRONÓSTICO -->

    <div class="card shadow-lg border-0 rounded-4 mb-4">

        <div class="card-header header-agro rounded-top-4">

            <h5 class="mb-0">
                Pronóstico
            </h5>

        </div>

        <div class="card-body">

            <div
                id="forecast-container"
                class="row g-3"
            >

            </div>

        </div>

    </div>



    <!-- GRÁFICA -->

    <div class="card shadow-lg border-0 rounded-4">

        <div class="card-header header-agro rounded-top-4">

            <h5 class="mb-0">
                Temperaturas Próximos Días
            </h5>

        </div>

        <div class="card-body">

            <div id="chart-container"></div>

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

<style>

    .weather-card {

        background: #f8f9fa;

        border-radius: 15px;

        padding: 20px;

        text-align: center;

        height: 100%;

        transition: 0.3s;

    }

    .weather-card:hover {

        transform: translateY(-5px);

        box-shadow: 0 8px 20px rgba(0,0,0,0.1);

    }

    .weather-temp {

        font-size: 3rem;

        font-weight: bold;

        color: #198754;

    }

    .forecast-day {

        border-radius: 15px;

        background: #f8f9fa;

        padding: 15px;

        text-align: center;

        height: 100%;

    }

</style>

@endsection



@section('js')

<script src="https://cdn.plot.ly/plotly-2.35.2.min.js"></script>

<script>

fetch(

    'https://api.open-meteo.com/v1/forecast?latitude=4.6097&longitude=-74.0817&current=temperature_2m,relative_humidity_2m,wind_speed_10m&daily=temperature_2m_max,temperature_2m_min&timezone=auto'

)

.then(response => response.json())

.then(data => {

    // =========================
    // CLIMA ACTUAL
    // =========================

    document.getElementById('weather-container').innerHTML = `

        <div class="weather-card">

            <div class="weather-temp">

                ${data.current.temperature_2m} °C

            </div>

            <h4 class="mt-3">
                Temperatura Actual
            </h4>

            <hr>

            <div class="row mt-4">

                <div class="col-md-4">

                    <h6>💧 Humedad</h6>

                    <p>
                        ${data.current.relative_humidity_2m}%
                    </p>

                </div>

                <div class="col-md-4">

                    <h6>🌬️ Viento</h6>

                    <p>
                        ${data.current.wind_speed_10m} km/h
                    </p>

                </div>

                <div class="col-md-4">

                    <h6>📍 Ubicación</h6>

                    <p>
                        Finca Principal
                    </p>

                </div>

            </div>

        </div>

    `



    // =========================
    // PRONÓSTICO
    // =========================

    let forecastHTML = ""

    data.daily.time.forEach((date, index) => {

        forecastHTML += `

            <div class="col-md-3">

                <div class="forecast-day">

                    <h6>
                        ${date}
                    </h6>

                    <hr>

                    <p>
                        🌡️ Máx:
                        <strong>
                            ${data.daily.temperature_2m_max[index]}°C
                        </strong>
                    </p>

                    <p>
                        ❄️ Mín:
                        <strong>
                            ${data.daily.temperature_2m_min[index]}°C
                        </strong>
                    </p>

                </div>

            </div>

        `

    })

    document.getElementById('forecast-container').innerHTML =
        forecastHTML



    // =========================
    // GRÁFICA TEMPERATURAS
    // =========================

    Plotly.newPlot(

        'chart-container',

        [

            {

                x: data.daily.time,

                y: data.daily.temperature_2m_max,

                type: 'scatter',

                name: 'Temperatura Máxima'

            },

            {

                x: data.daily.time,

                y: data.daily.temperature_2m_min,

                type: 'scatter',

                name: 'Temperatura Mínima'

            }

        ],

        {

            title: 'Pronóstico de Temperaturas',

            xaxis: {

                title: 'Fecha'

            },

            yaxis: {

                title: 'Temperatura °C'

            }

        }

    )

})

.catch(error => {

    console.error(error)

})

</script>

@endsection