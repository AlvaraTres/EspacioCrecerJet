<div>
    <div id="pagospormes"></div>

    @push('js')
        <script type="text/javascript">
            document.addEventListener('livewire:load', function(){
                var pagosXMes = @this.pagosXMes;
                console.log(pagosXMes);

                var chart = Highcharts.chart('pagospormes', {
                    title: {
                        text: 'Reporte de Pagos'
                    },
                    subtitle: {
                        text: 'Fuente: Espacio Crecer S.A.'
                    },
                    xAxis: {
                        categories: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto',
                            'Septiembre',
                            'Octubre', 'Noviembre', 'Diciembre'
                        ]
                    },
                    yAxis: {
                        title: {
                            text: 'Cantidad de pagos registrados'
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
                        name: 'Cantidad de pagos',
                        data: JSON.parse(pagosXMes)
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
            });

            document.addEventListener("DOMContentLoaded", () => {
                Livewire.hook('element.updated', (el, component) => {
                    var pagosXMes = @this.pagosXMes;
                    console.log(pagosXMes);

                    var chart = Highcharts.chart('pagospormes', {
                    title: {
                        text: 'Reporte de Pagos'
                    },
                    subtitle: {
                        text: 'Fuente: Espacio Crecer S.A.'
                    },
                    xAxis: {
                        categories: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto',
                            'Septiembre',
                            'Octubre', 'Noviembre', 'Diciembre'
                        ]
                    },
                    yAxis: {
                        title: {
                            text: 'Cantidad de pagos registrados'
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
                        name: 'Cantidad de pagos',
                        data: JSON.parse(pagosXMes)
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
                });
            });
        </script>
    @endpush
</div>
