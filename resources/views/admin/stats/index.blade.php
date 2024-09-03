@extends('layouts.admin')

@section('content')
<div class="cotainter">
    <div class="row mt-3 mb-5">
        <div class="col-12 col-sm-12 col-md-6 flex-center gap-2">
            {{-- btn home --}}
            <a class="btn btn-primary btn-form-action rounded-5 px-2 py-1" href="{{ route('admin.orders.index') }}">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            {{-- btn home --}}

            {{-- title --}}
            <h1 class="text-center p-0 m-0">Statistiche degli Ordini</h1>
            {{-- /title --}}
        </div>

        <div class="col-12 col-sm-12 col-md-6 flex-center">
            <form method="GET" action="{{ route('admin.stats.index') }}" class="d-flex gap-2">
                <div>
                    <label for="year">Anno:</label>
                    <input type="number" id="year" name="year" value="{{ $year }}"
                        class="form-control">
                </div>
                <div>
                    <label for="month">Mese:</label>
                    <input type="number" id="month" name="month" value="{{ $month }}"
                        class="form-control">
                </div>
                <div class="d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Filtra</button>
                </div>
            </form>
        </div>

    </div>
</div>

    <div class="container-fluid">
        <div class="row">


            <div class="container">
                <div class="row justify-content-center">
                    {{-- Orders graph --}}
                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 chart-section mb-5">
                        <h3 class="text-left">Ordini per giornata</h3>
                        <p class="text-left">Totale numero ordini del mese selezionato: {{ $totalOrders }}</p>
                        <div class="select-container">
                            <select id="chart-order" class="my_select rounded-3 px-3" >
                                <option value="line">Linee</option>
                                <option value="bar">Barre</option>
                            </select>
                        </div>
                        <div class="chart-container">
                            <canvas id="orderChart"></canvas>
                        </div>
                    </div>
                    {{-- /Orders graph --}}
                    {{-- Price graph --}}
                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 chart-section">
                        <h3 class="text-left">Guadagni della giornata</h3>
                        <p class="text-left">Totale guadagnato nel mese selezionato: {{ number_format($totalEarnings, 2) }} €</p>
                        <div class="select-container">
                            <select id="chart-price" class="rounded-3 px-3">
                                <option value="bar">Barre</option>
                                <option value="line">Linee</option>
                            </select>
                        </div>
                        <div class="chart-container">
                            <canvas id="PriceChart"></canvas>
                        </div>
                    </div>
                    {{-- /Price graph --}}
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Order graph (first graph)
        document.addEventListener('DOMContentLoaded', (event) => {
            const orderCtx = document.getElementById('orderChart').getContext('2d');

            const lineDataset = {
                label: 'Ordini',
                data: @json(array_values($data)),
                borderColor: 'blue',
                borderWidth: 2,
                fill: false,
                tension: 0.1,
                type: 'line'
            };

            const barDataset = {
                label: 'Ordini',
                data: @json(array_values($data)),
                backgroundColor: 'blue',
                borderWidth: 2,
                fill: false,
                type: 'bar'
            };

            const data = {
                labels: @json(array_keys($data)),
                datasets: [lineDataset] // Start with line dataset
            };

            const options = {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            };

            let orderChart = new Chart(orderCtx, {
                data: data,
                options: options
            });

            document.getElementById('chart-order').addEventListener('change', (event) => {
                const selectedType = event.target.value;
                orderChart.destroy();
                if (selectedType === 'line') {
                    orderChart = new Chart(orderCtx, {
                        type: 'line',
                        data: {
                            labels: @json(array_keys($data)),
                            datasets: [lineDataset]
                        },
                        options: options
                    });
                } else if (selectedType === 'bar') {
                    orderChart = new Chart(orderCtx, {
                        type: 'bar',
                        data: {
                            labels: @json(array_keys($data)),
                            datasets: [barDataset]
                        },
                        options: options
                    });
                }
            });
        });

        // Price graph (second graph)
        document.addEventListener('DOMContentLoaded', (event) => {
            const priceCtx = document.getElementById('PriceChart').getContext('2d');

            const lineDataset = {
                label: 'Guadagni in €',
                data: @json(array_values($totalPrices)),
                borderColor: 'red',
                borderWidth: 2,
                fill: false,
                tension: 0.1,
                type: 'line'
            };

            const barDataset = {
                label: 'Guadagni in €',
                data: @json(array_values($totalPrices)),
                backgroundColor: 'red',
                borderWidth: 2,
                fill: false,
                type: 'bar'
            };

            const data = {
                labels: @json(array_keys($totalPrices)),
                datasets: [barDataset] // Start with bar dataset
            };

            const options = {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value, index, values) {
                                return value + ' €';
                            }
                        }
                    }
                }
            };

            let priceChart = new Chart(priceCtx, {
                data: data,
                options: options
            });

            document.getElementById('chart-price').addEventListener('change', (event) => {
                const selectedType = event.target.value;
                priceChart.destroy();
                if (selectedType === 'line') {
                    priceChart = new Chart(priceCtx, {
                        type: 'line',
                        data: {
                            labels: @json(array_keys($totalPrices)),
                            datasets: [lineDataset]
                        },
                        options: options
                    });
                } else if (selectedType === 'bar') {
                    priceChart = new Chart(priceCtx, {
                        type: 'bar',
                        data: {
                            labels: @json(array_keys($totalPrices)),
                            datasets: [barDataset]
                        },
                        options: options
                    });
                }
            });
        });
    </script>

    <style>
        /* .chart-section {
            width: 100%;
            max-width: 800px;
        }

        .chart-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            width: 100%;
        }

        .chart-wrapper {
            width: 100%;
        }

        .select-container {
            position: relative;
            display: inline-block;
            width: 200px;
        }

        select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border: 1px solid lightgray;
            background-color: white;
            padding: 5px;
            font-size: 16px;
            color: black;
            width: 100%;
            cursor: pointer;
            outline: none;
            border-radius: 10px;
        }

        .select-icon {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            pointer-events: none;
            color: black;
        }

        select option {
            background-color: white;
            color: black;
            padding: 10px;
        }

        select:hover,
        select:focus {
            border: 1px solid black;
        }


        form {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        form label,
        form input,
        form button {
            margin: 0 10px;
        }

        .text-left {
            width: 100%;
            text-align: left;
            margin-bottom: 10px;
        } */
    </style>
@endsection
