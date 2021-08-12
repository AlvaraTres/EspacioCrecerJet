<div>
    <div class="mx-auto bg-white w-full">
        <p class="ml-3 px-4 py-2">Filtros de búsqueda</p>
        <div class="flex items-stretch bg-white w-full px-4 py-2">
            <select
                class="ml-3 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                name="selectOpt" id="selectOpt" wire:model="tipoFiltro">
                <option value="">Seleccionar Filtro</option>
                <option value="1">Filtrar por Año/Mes</option>
                <option value="2">Filtrar por Rango de Tiempo</option>
            </select>
        </div>

        @if ($tipoFiltro == 1)
            
            <div class="flex items-stretch bg-white w-full px-4 py-2">
                <select
                    class="ml-3 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    name="anio" id="anio" wire:model="anioSelect">
                    <option selected disabled>Seleccionar Año</option>
                    <option value="2019" class="border-gray-300">2019</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                </select>

                <select
                    class="ml-3 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    name="mes" id="mes" wire:model="mesSelect" @if($enabledSelect != 1) disabled @endif>
                    <option selected disabled>Seleccionar Mes</option>
                    <option value="1">Enero</option>
                    <option value="2">Febrero</option>
                    <option value="3">Marzo</option>
                    <option value="4">Abril</option>
                    <option value="5">Mayo</option>
                    <option value="6">Junio</option>
                    <option value="7">Julio</option>
                    <option value="8">Agosto</option>
                    <option value="9">Septiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>
                </select>
                <x-jet-danger-button wire:click="resetFilt()"
                    class="ml-3 inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 active:bg-green-600 disabled:opacity-25 transition">
                    Resetear Filtros
                </x-jet-danger-button>
            </div>
        @else
            @if ($tipoFiltro == 2)
                <div class="flex items-stretch bg-white w-full px-4 py-2">
            @endif
                    <input placeholder="Desde" class="ml-3 datetimepicker-input rounded-md border-gray-300"
                        id="dateDesde" wire:model="from" readonly @if($tipoFiltro != 2) type="hidden" @else type="text"  @endif>
                    <input placeholder="Hasta" class="ml-3 datetimepicker-input rounded-md border-gray-300"
                        id="dateHasta" wire:model="to" readonly @if($tipoFiltro != 2) type="hidden" @else type="text"  @endif>
            @if($tipoFiltro == 2)
                    <x-jet-danger-button wire:click="resetFilt()"
                        class="ml-3 inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 active:bg-green-600 disabled:opacity-25 transition">
                        Resetear Filtros
                    </x-jet-danger-button>
                </div>
            @endif
        @endif
    </div>








    <div id="categoriasChart"></div>

    @push('js')
        <script type="text/javascript">
            document.addEventListener('livewire:load', function() {
                var datos = jQuery.parseJSON(@this.data);
                console.log(datos);

                Highcharts.chart('categoriasChart', {
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie'
                    },
                    title: {
                        text: 'Reporte de categorías de fichas médicas'
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                    },
                    accessibility: {
                        point: {
                            valueSuffix: '%'
                        }
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: true,
                                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                            }
                        }
                    },
                    series: [{
                        name: 'Porcentaje de fichas médicas',
                        colorByPoint: true,
                        data: datos
                    }]
                });
            });

            document.addEventListener("DOMContentLoaded", () => {
                Livewire.hook('element.updated', (el, component) => {
                    var datos = jQuery.parseJSON(@this.data);
                    if(datos.length == 0){
                        console.log("hola");
                    }
                    console.log("Elemento update");
                    console.log(datos);

                    Highcharts.chart('categoriasChart', {
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: 'Reporte de categorías de fichas médicas'
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        accessibility: {
                            point: {
                                valueSuffix: '%'
                            }
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                                }
                            }
                        },
                        series: [{
                            name: 'Porcentaje de fichas médicas',
                            colorByPoint: true,
                            data: datos
                        }]
                    });
                });
            });
        </script>
        <script type="text/javascript">
            jQuery(function() {
                jQuery.datetimepicker.setLocale('es');
                jQuery('#dateDesde').datetimepicker({
                    format: 'Y-m-d',
                    onShow: function(ct) {
                        this.setOptions({
                            maxDate: jQuery('#dateHasta').val() ? jQuery('#dateHasta').val() :
                                false,
                        })
                    },
                    timepicker: false,
                }).on('change', function(e) {
                    console.log(jQuery('#dateDesde').val());
                    @this.set('from', jQuery('#dateDesde').val());
                });
                jQuery('#dateHasta').datetimepicker({
                    format: 'Y-m-d',
                    onShow: function(ct) {
                        this.setOptions({
                            minDate: jQuery('#dateDesde').val() ? jQuery('#dateDesde').val() : false
                        })
                    },
                    timepicker: false,
                });
            }).on('change', function(e) {
                @this.set('to', jQuery('#dateHasta').val());
            });
        </script>
    @endpush
</div>
