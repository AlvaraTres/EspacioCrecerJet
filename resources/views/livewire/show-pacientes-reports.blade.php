<div>
    <div class="mx-auto bg-white-200 w-full">
        <p class="px-4 py-2">Filtros de búsqueda</p>
        <select class="ml-3 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="anioSearch" id="anioSearch" wire:model="anioSearch">
            <option value="#">Seleccionar</option>
            <option value="2020">2020</option>
            <option value="2021">2021</option>
            <option value="2022">2022</option>
        </select>
    </div>

    <div id="container"></div>

    @push('js')

        <script type="text/javascript">
            document.addEventListener('livewire:load', function() {
                var data = @this.datas;

                console.log(data);

                var chart = Highcharts.chart('container', {
                    title: {
                        text: 'Nuevos Pacientes'
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
            });

            document.addEventListener("DOMContentLoaded", ()=>{
                Livewire.hook('element.updated', (el, component) => {
                    var data = @this.datas;
                    console.log(data);

                    var chart = Highcharts.chart('container', {
                    title: {
                        text: 'Nuevos Pacientes'
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
                });
            });
            
        </script>
    @endpush
</div>
