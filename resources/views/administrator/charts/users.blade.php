@extends('layouts.administrator')


@section('content')
    <div class="layout-manager">
        <h3>Novos Usuários</h3>
        <hr>
        <div id="container"></div>
    </div>

@endsection
@section('scripts')
    <script src="https://code.highcharts.com/highcharts.js"></script>

    <script type="text/javascript">
        var datas =  <?php echo json_encode($datas) ?>;

        Highcharts.chart('container', {
            title: {
                text: 'Gráfico de registro de novos usuários'
            },
            subtitle: {
                text: 'Marketplace'
            },
            xAxis: {
                categories: ['Janeiro','Fevereiro','Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro']
            },
            yAxis: {
                title: {
                    text: 'Registro de usuários'
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            series: [{
                name: 'Novos usuários',
                data: datas
            }],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 400
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });
    </script>
@endsection
