<div>
    <div class="mx-auto bg-white-200 w-full">
        <p class="px-4 py-2">Filtros de búsqueda</p>
        <div class="flex items-stretch bg-white-300 w-full px-4 py-2">
            <select
                class="ml-3 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                name="filtPsicologo" id="filtPsicologo" wire:model="selectedPsicologo">
                <option value="">Seleccionar psicológo</option>
                @foreach ($filtPsicologo as $item)
                    <option value="{{ $item->id }}">{{ $item->psicologo }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div id="chartTotalPagos"></div>

    @push('js')
        <script type="text/javascript">
            document.addEventListener("livewire:load", function() {
                var datos = jQuery.parseJSON(@this.data);
                console.log(datos);

                var ingresosAnio = datos.ingresosData[0];
                var ingresosMes = datos.ingresosData[1];
                var ingresosDia = datos.ingresosData[2];

                console.log(ingresosAnio);
                console.log(ingresosMes);
                console.log(ingresosDia[1].dias);

                series = [];
                drilldown = [];

                for (i = 0; i < ingresosAnio.length; i++) {
                    series.push({
                        y: parseInt(ingresosAnio[i].total),
                        x: ingresosAnio[i].anio,
                        myData: "Total: " + ingresosAnio[i].total,
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
                                    y: parseInt(ingresosDia[k].total),
                                    x: parseInt(dia[2]),
                                    name: dia[2] + " " + dia[0] + " " + dia[1],
                                    myData: "Total: " + ingresosDia[k].total
                                });
                            }
                        }

                        drilldown.push({
                            name: "Ingresos Mensuales",
                            id: 'dia' + j,

                            data: drillSeries2,
                            colorByPoint: true,
                        });

                        if (anio[1] == ingresosAnio[i].anio) {
                            drillSeries.push({
                                y: parseInt(ingresosMes[i].total),
                                x: parseInt(anio[2]),
                                name: anio[0] + " " + anio[1],
                                myData: "Total: " + ingresosMes[j].total,
                                drilldown: 'dia' + j,
                            });
                        }
                    }
                    drilldown.push({
                        name: 'Ingresos Mensuales',
                        id: 'mes' + i,
                        data: drillSeries,
                        colorByPoint: true,
                    });
                }
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
                        type: 'category',
                        title: {
                            text: 'Fecha'
                        },
                    },
                    tooltip: {
                        formatter: function() {
                            return 'Ingresos: <b>$' + this.point.y + '/' + this.point.myData + '</b>';
                        }
                    },
                    legend: {
                        enabled: false
                    },
                    series: [{
                        name: 'Ingresos Anuales',
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

                    var ingresosAnio = datos.ingresosData[0];
                    var ingresosMes = datos.ingresosData[1];
                    var ingresosDia = datos.ingresosData[2];

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
                                y: parseInt(ingresosAnio[i].total),
                                x: ingresosAnio[i].anio,
                                myData: "Total: " + ingresosAnio[i].total,
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
                                            y: parseInt(ingresosDia[k].total),
                                            x: parseInt(dia[2]),
                                            name: dia[2] + " " + dia[0] + " " + dia[1],
                                            myData: "Total: " + ingresosDia[k].total
                                        });
                                    }
                                }

                                drilldown.push({
                                    name: "Ingresos Mensuales",
                                    id: 'dia' + j,

                                    data: drillSeries2,
                                    colorByPoint: true,
                                });

                                if (anio[1] == ingresosAnio[i].anio) {
                                    drillSeries.push({
                                        y: parseInt(ingresosMes[i].total),
                                        x: parseInt(anio[2]),
                                        name: anio[0] + " " + anio[1],
                                        myData: "Total: " + ingresosMes[j].total,
                                        drilldown: 'dia' + j,
                                    });
                                }
                            }
                            drilldown.push({
                                name: 'Ingresos Mensuales',
                                id: 'mes' + i,
                                data: drillSeries,
                                colorByPoint: true,
                            });
                        }
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
                                type: 'category',
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
                                data: series
                            }],
                            drilldown: {
                                series: drilldown
                            }
                        });
                    }
                });
            });
        </script>
    @endpush
</div>
