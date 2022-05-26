@extends('layouts.administrator')


@section('content')
    <div class="layout-manager">
        <h3>Gráfico de vendas</h3>
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
                text: 'Gráfico de registro de vendas mensais'
            },
            subtitle: {
                text: 'Marketplace'
            },
            xAxis: {
                categories: ['Janeiro','Fevereiro','Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro']
            },
            yAxis: {
                title: {
                    text: 'Quantidade de Vendas'
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
                name: 'Novas vendas',
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
