<div>
    <div class="mx-auto bg-white-200 w-full">
        
        
        <p class="px-4 py-2">Filtros de búsqueda</p>
        <div class="flex items-stretch bg-white-300 w-full px-4 py-2">
            <select class="ml-3 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="filtPsicologo" id="filtPsicologo" wire:model="selectedPsicologo">
                <option value="">Seleccionar psicológo</option>
                @foreach ($filtPsicologo as $item)
                    <option value="{{$item->id}}">{{$item->psicologo}}</option>
                @endforeach
            </select> 
            <select class="ml-3 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="anioSearchTotalPagos" id="anioSearchTotalPagos" wire:model="anioSearchTotalPagos">
                <option value="#">Seleccionar</option>
                <option value="2020">2020</option>
                <option value="2021">2021</option>
                <option value="2022">2022</option>
                <option value="2023">2023</option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>
                <option value="2026">2026</option>
                <option value="2027">2027</option>
                <option value="2028">2028</option>
            </select>     
        </div>
    </div>

    <div id="chartTotalPagos"></div>

    @push('js')
        <script type="text/javascript">
            document.addEventListener("livewire:load", function() {
                var data = @this.totalPagosArray;
                console.log(data);

                var chart = Highcharts.chart('chartTotalPagos', {
                    title: {
                        text: 'Monto Total de Pagos'
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
                            text: 'Suma total de pagos registrados'
                        }
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'middle'
                    },
                    plotOptions: {
                        series: {
                            borderWidth: 0,
                            dataLabels: {
                                enabled: true,
                                format: '${y}'
                            }
                        }
                    },
                    series: [{
                        type: 'column',
                        name: 'Total',
                        colorByPoint: true,
                        data: JSON.parse(data),
                        drilldown: JSON.parse(data)
                    }],
                    drilldown: {
                        series:{
                            name: "Total",
                            id: JSON.parse(data),
                            data: [
                                "v65.0",
                                0.1
                            ]
                        }
                    },
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
                    var data = @this.totalPagosArray;
                    console.log(data);

                    var chart = Highcharts.chart('chartTotalPagos', {
                        title: {
                            text: 'Monto Total de Pagos'
                        },
                        subtitle: {
                            text: 'Fuente: Espacio Crecer S.A.'
                        },
                        xAxis: {
                            categories: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio',
                                'Agosto',
                                'Septiembre',
                                'Octubre', 'Noviembre', 'Diciembre'
                            ]
                        },
                        yAxis: {
                            title: {
                                text: 'Suma total de pagos registrados'
                            }
                        },
                        legend: {
                            layout: 'vertical',
                            align: 'right',
                            verticalAlign: 'middle'
                        },
                        plotOptions: {
                            series: {
                            borderWidth: 0,
                            dataLabels: {
                                enabled: true,
                                format: '${y}'
                            }
                        }
                        },
                        series: [{
                            type: 'column',
                            name: 'Total',
                            colorByPoint: true,
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
                });
            });
        </script>
    @endpush
</div>
