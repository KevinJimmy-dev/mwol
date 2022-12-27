@extends('panel.template')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>

        <div class="row">
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Palavras
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $counter['words'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-book fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Frases
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $counter['phrases'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-bookmark fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Idiomas
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $counter['languages'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-fw fa-globe fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary"> Palavras Cadastradas</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <canvas id="myAreaChart" style="display: block; width: 585px; height: 320px;" width="585"
                                height="320" class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary"> Idiomas Cadastrados</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <p id="reason"></p>
                            <canvas id="myPieChart" width="259" height="245"
                                style="display: block; width: 259px; height: 245px;"
                                class="chartjs-render-monitor"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                            @foreach ($chart['pie']['languages'] ?? [] as $language)
                                <span class="mr-2">
                                    <i class="fas fa-circle text-primary"></i> {{ $language }}
                                </span>
                            @endforeach

                            @if (empty($chart['pie']['languages']))
                                <span class="mr-2">
                                    Nenhum idioma cadastrado ainda 😢
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Ultimas Frases Cadastradas</h6>
            </div>

            <div class="card-body">
                @if (count($phrases) > 0)
                    <div class="table-responsive">
                        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="col-sm-12">
                                <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0"
                                    role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                    <thead>
                                        <tr role="row">
                                            <th class="text-center">Idioma</th>
                                            <th>Frase</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($phrases as $phrase)
                                            <tr>
                                                <td class="text-center" style="color: {{ $phrase->word->language->theme }}">{{ $phrase->word->language->name }}</td>
                                                <td>{{ $phrase->phrase }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @else
                    <p class="text-center mt-3">Nenhuma frase cadastrada ainda 😢</p>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="vendor/chart.js/Chart.min.js"></script>

    <script>
        Chart.defaults.global.defaultFontFamily = 'Nunito',
            '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        var ctx = document.getElementById("myAreaChart");

        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [{{ implode(',', $chart['area']['days']) }}],
                datasets: [{
                    label: "Palavras",
                    lineTension: 0.3,
                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                    borderColor: "rgba(78, 115, 223, 1)",
                    pointRadius: 3,
                    pointBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointBorderColor: "rgba(78, 115, 223, 1)",
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                    data: [{{ implode(',', $chart['area']['amount']) }}],
                }],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'date'
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 7
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            maxTicksLimit: 5,
                            beginAtZero: true,
                            padding: 10,
                            callback: function(value, index, values) {
                                return value;
                            }
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                },
                legend: {
                    display: false
                },
            }
        });
    </script>

    <script>
        Chart.defaults.global.defaultFontFamily = 'Nunito',
            '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        let labels = "{{ json_encode($chart['pie']['languages']) }}";

        labels = labels.replace(/&quot;/g, '').split(",").map(function(e) {
            return e.replace("[", "").replace("]", "");
        });

        let data = {{ json_encode($chart['pie']['amount']) }};

        let theme = "{{ json_encode($chart['pie']['theme']) }}";

        theme = theme.replace(/&quot;/g, '').split(",").map(function(e) {
            return e.replace("[", "").replace("]", "");
        });

        let hover = "{{ json_encode($chart['pie']['hover']) }}";

        hover = hover.replace(/&quot;/g, '').split(",").map(function(e) {
            return e.replace("[", "").replace("]", "");
        });

        var ctx = document.getElementById("myPieChart");
        var myPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels[0] == "" ? ['Nenhum idioma cadastrado'] : labels,
                datasets: [{
                    data: data.length == 0 ? [1] : data,
                    backgroundColor: data.length == 0 ? ['#858796'] : theme,
                    hoverBackgroundColor: hover[0] == "" ? ['#858796'] : hover,
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: false
                },
                cutoutPercentage: 80,
            },
        });
    </script>
@endsection
