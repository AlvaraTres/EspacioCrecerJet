<div>
    <div class="mx-auto bg-white-200 w-full">
        <p class="px-4 py-2">Filtros de búsqueda</p>
        <div class="flex items-stretch bg-white-300 w-full px-4 py-2">
            <select
                class="ml-3 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                id="searchPaciente" name="searchPsico" wire:model="searchPsico">
                <option value="0">Seleccionar psicológo</option>
                @foreach ($filterPsico as $fps)
                    <option value="{{ $fps->id }}">{{ $fps->psicologo }}</option>
                @endforeach
            </select>

            <select
                class="ml-3 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                id="searchPaciente" name="searchPaciente" wire:model="searchPaciente">
                <option value="0">Seleccionar paciente</option>
                @foreach ($filterPaciente as $fp)
                    <option value="{{ $fp->id }}">{{ $fp->paciente }}</option>
                @endforeach
            </select>

            <x-jet-danger-button wire:click="resetFilt()"
                class="ml-3 inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 active:bg-green-600 disabled:opacity-25 transition">
                Resetear Filtros
            </x-jet-danger-button>
        </div>
    </div>

    <div id="reservasChart"></div>

    @push('js')
        <script type="text/javascript">
            document.addEventListener('livewire:load', function() {
                var datos = jQuery.parseJSON(@this.data);
                console.log(datos);

                var ingresosAnio = datos.reservasData[0];
                var ingresosMes = datos.reservasData[1];
                var ingresosDia = datos.reservasData[2];

                console.log(ingresosAnio);
                console.log(ingresosMes);
                console.log(ingresosDia[1].dias);

                series = [];
                drilldown = [];

                for (i = 0; i < ingresosAnio.length; i++) {
                    series.push({
                        y: parseInt(ingresosAnio[i].cont),
                        x: ingresosAnio[i].anio,
                        myData: "Total: " + ingresosAnio[i].cont,
                        drilldown: 'mes' + i
                    });

                    drillSeries = [];

                    for (j = 0; j < ingresosMes.length; j++) {

                        drillSeries2 = [];
                        anio = ingresosMes[j].meses.split(" ");

                        for (k = 0; k < ingresosDia.length; k++) {
                            dia = ingresosDia[k].dias.split(" ");

                            if (dia[0] + " " + dia[1] == anio[0] + " " + anio[1]) {
                                drillSeries2.push({
                                    y: parseInt(ingresosDia[k].cont),
                                    x: parseInt(dia[2]),
                                    name: dia[2] + " " + dia[0] + " " + dia[1],
                                    myData: "Total: " + ingresosDia[k].cont
                                });
                            }
                        }

                        drilldown.push({
                            name: "Reservas Mensuales",
                            id: 'dia' + j,

                            data: drillSeries2,
                            colorByPoint: true,
                        });

                        if (anio[1] == ingresosAnio[i].anio) {
                            drillSeries.push({
                                y: parseInt(ingresosMes[j].cont),
                                x: parseInt(anio[2]),
                                name: anio[0] + " " + anio[1],
                                myData: "Total: " + ingresosMes[j].cont,
                                drilldown: 'dia' + j,
                            });
                        }
                    }
                    drilldown.push({
                        name: 'Reservas Mensuales',
                        id: 'mes' + i,
                        data: drillSeries,
                        colorByPoint: true,
                    });
                }

                Highcharts.setOptions({
                    lang: {
                        months: [
                            'Janvier', 'Février', 'Mars', 'Avril',
                            'Mai', 'Juin', 'Juillet', 'Août',
                            'Septembre', 'Octobre', 'Novembre', 'Décembre'
                        ],
                        weekdays: [
                            'Dimanche', 'Lundi', 'Mardi', 'Mercredi',
                            'Jeudi', 'Vendredi', 'Samedi'
                        ],
                        drillUpText: 'Volver atrás',
                    }
                });

                $('#reservasChart').highcharts({
                    chart: {
                        type: 'column',
                        zoomType: 'x'
                    },
                    title: {
                        text: 'Total Reservas'
                    },
                    yAxis: {
                        title: {
                            text: 'Cantidad de reservas'
                        },
                    },
                    xAxis: {
                        type: 'category',
                        title: {
                            text: 'Fecha'
                        },
                    },
                    tooltip: {
                        formatter: function() {
                            return 'Reservas: <b>' + this.point.y + '/' + this.point.myData + '</b>';
                        }
                    },
                    legend: {
                        enabled: false
                    },
                    series: [{
                        name: 'Cantidad Reservas Anuales',
                        colorByPoint: true,
                        data: series
                    }],
                    drilldown: {
                        series: drilldown
                    }
                });
            });

            document.addEventListener("DOMContentLoaded", () => {
                Livewire.hook('element.updated', (el, component) => {
                    var datos = jQuery.parseJSON(@this.data);
                    console.log(datos);

                    var ingresosAnio = datos.reservasData[0];
                    var ingresosMes = datos.reservasData[1];
                    var ingresosDia = datos.reservasData[2];

                    console.log(ingresosAnio);
                    console.log(ingresosMes);

                    series = [];
                    drilldown = [];

                    if (ingresosAnio.length == 0) {
                        $('#chartTotalPagos').highcharts({
                            chart: {
                                type: 'column',
                                zoomType: 'x'
                            },
                            title: {
                                text: 'Total Ingresos'
                            },
                            yAxis: {
                                title: {
                                    text: 'Monto de Ingresos'
                                },
                            },
                            xAxis: {
                                categories: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                                    'Julio', 'Agosto',
                                    'Septiembre',
                                    'Octubre', 'Noviembre', 'Diciembre'
                                ],
                                title: {
                                    text: 'Fecha'
                                },
                            },
                            tooltip: {
                                formatter: function() {
                                    return 'Ingresos: <b>$' + this.point.y + '/' + this.point
                                        .myData +
                                        '</b>';
                                }
                            },
                            legend: {
                                enabled: false
                            },
                            series: [{
                                name: 'Ingresos Anuales',
                                colorByPoint: true,
                                data: {}
                            }]
                        });
                    } else {
                        for (i = 0; i < ingresosAnio.length; i++) {
                            series.push({
                                y: parseInt(ingresosAnio[i].cont),
                                x: ingresosAnio[i].anio,
                                myData: "Total: " + ingresosAnio[i].cont,
                                drilldown: 'mes' + i
                            });

                            drillSeries = [];

                            for (j = 0; j < ingresosMes.length; j++) {

                                drillSeries2 = [];
                                anio = ingresosMes[j].meses.split(" ");

                                for (k = 0; k < ingresosDia.length; k++) {
                                    dia = ingresosDia[k].dias.split(" ");

                                    if (dia[0] + " " + dia[1] == anio[0] + " " + anio[1]) {
                                        drillSeries2.push({
                                            y: parseInt(ingresosDia[k].cont),
                                            x: parseInt(dia[2]),
                                            name: dia[2] + " " + dia[0] + " " + dia[1],
                                            myData: "Total: " + ingresosDia[k].cont
                                        });
                                    }
                                }

                                drilldown.push({
                                    name: "Reservas Mensuales",
                                    id: 'dia' + j,

                                    data: drillSeries2,
                                    colorByPoint: true,
                                });

                                if (anio[1] == ingresosAnio[i].anio) {
                                    drillSeries.push({
                                        y: parseInt(ingresosMes[j].cont),
                                        x: parseInt(anio[2]),
                                        name: anio[0] + " " + anio[1],
                                        myData: "Total: " + ingresosMes[j].cont,
                                        drilldown: 'dia' + j,
                                    });
                                }
                            }
                            drilldown.push({
                                name: 'Reservas Mensuales',
                                id: 'mes' + i,
                                data: drillSeries,
                                colorByPoint: true,
                            });
                        }
                    }
                    Highcharts.setOptions({
                        lang: {
                            months: [
                                'Janvier', 'Février', 'Mars', 'Avril',
                                'Mai', 'Juin', 'Juillet', 'Août',
                                'Septembre', 'Octobre', 'Novembre', 'Décembre'
                            ],
                            weekdays: [
                                'Dimanche', 'Lundi', 'Mardi', 'Mercredi',
                                'Jeudi', 'Vendredi', 'Samedi'
                            ],
                            drillUpText: 'Volver atrás',
                        }
                    });

                    $('#reservasChart').highcharts({
                        chart: {
                            type: 'column',
                            zoomType: 'x'
                        },
                        title: {
                            text: 'Total Reservas'
                        },
                        yAxis: {
                            title: {
                                text: 'Cantidad de reservas'
                            },
                        },
                        xAxis: {
                            type: 'category',
                            title: {
                                text: 'Fecha'
                            },
                        },
                        tooltip: {
                            formatter: function() {
                                return 'Reservas: <b>' + this.point.y + '/' + this.point.myData +
                                    '</b>';
                            }
                        },
                        legend: {
                            enabled: false
                        },
                        series: [{
                            name: 'Cantidad Reservas Anuales',
                            colorByPoint: true,
                            data: series
                        }],
                        drilldown: {
                            series: drilldown
                        }
                    });
                });
            });
        </script>
    @endpush
</div>
