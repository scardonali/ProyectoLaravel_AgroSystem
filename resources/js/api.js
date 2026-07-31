console.log("Dashboard conectado a MySQL")


fetch(
    'https://api.open-meteo.com/v1/forecast?latitude=4.6097&longitude=-74.0817&current=temperature_2m,relative_humidity_2m,wind_speed_10m&daily=temperature_2m_max,temperature_2m_min'
)

.then(response => response.json())

.then(data => {

    // =========================
    // CLIMA ACTUAL
    // =========================

    document.getElementById('weather-container').innerHTML = `

        <div class="card p-4 mb-4">

            <h2>
                ${data.current.temperature_2m} °C
            </h2>

            <p>
                Humedad:
                ${data.current.relative_humidity_2m}%
            </p>

            <p>
                Viento:
                ${data.current.wind_speed_10m} km/h
            </p>

        </div>

    `


    // =========================
    // PRONÓSTICO
    // =========================

    let forecastHTML = ""

    data.daily.time.forEach((date, index) => {

        forecastHTML += `

            <div
                style="
                    border:1px solid #ccc;
                    padding:15px;
                    margin:10px;
                    border-radius:10px;
                "
            >

                <h4>${date}</h4>

                <p>
                    Máx:
                    ${data.daily.temperature_2m_max[index]} °C
                </p>

                <p>
                    Mín:
                    ${data.daily.temperature_2m_min[index]} °C
                </p>

            </div>

        `

    })

    document.getElementById('forecast-container').innerHTML =
        forecastHTML



    // =========================
    // GASTOS VS COSECHAS
    // =========================

    Plotly.newPlot(

        'chart-container',

        [{

            x: ['Gastos', 'Cosechas'],

            y: [
                window.expenses,
                window.harvests
            ],

            type: 'bar'

        }],

        {

            title: 'Gastos vs Cosechas'

        }

    )



    // =========================
    // STOCK INSUMOS
    // =========================

    const supplyNames =
        window.supplies.map(
            supply => supply.name
        )

    const supplyStock =
        window.supplies.map(
            supply => supply.current_stock
        )


    Plotly.newPlot(

        'stock-chart',

        [{

            labels: supplyNames,

            values: supplyStock,

            type: 'pie'

        }],

        {

            title: 'Stock de Insumos'

        }

    )

})

.catch(error => {

    console.error(error)

})

