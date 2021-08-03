<div>
    <div class="mx-auto bg-white-200 w-full">
        <p class="px-4 py-2">Filtros de búsqueda</p>
        <div class="flex items-stretch bg-white-300 w-full px-4 py-2">
            <select class="ml-3 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="anioSearchTotalPagos" id="anioSearchTotalPagos" wire:model="selectedAnio">
                <option value="#">Seleccionar</option>
                <option value="2020">2020</option>
                <option value="2021">2021</option>
                <option value="2022">2022</option>
            </select>
        </div>
    </div>
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
