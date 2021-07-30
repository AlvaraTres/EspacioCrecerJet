<div>

    <div id="container"></div>

    @push('js')

    <script type="text/javascript">
        var data = <?php echo json_encode($datas)?>;

        console.log(data);

        var chart = Highcharts.chart('container', {
            title: {
                text: 'Nuevos Pacientes'
            },
            subtitle: {
                text: 'Fuente: Espacio Crecer S.A.'
            },
            xAxis: {
                categories: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre',
                    'Octubre', 'Noviembre', 'Diciembre'
                ]
            },
            yAxis: {
                title: {
                    text: 'Número de pacientes registrados'
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },
            plotOptions: {
                series: {
                    allowPointSelect: true
                }
            },
            series: [{
                type: 'column',
                name: 'Nuevos pacientes',
                data: JSON.parse(data)
            }],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
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
    @endpush
</div>
