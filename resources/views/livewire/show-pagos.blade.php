<div>
    <div class="mx-auto bg-white-200 w-full">
        <p class="px-4 py-2">Filtros de búsqueda</p>
        <div class="flex items-stretch bg-white-300 w-full px-4 py-2">
            <input type="text" placeholder="Buscar Paciente" class="mr-2 rounded-md border-gray-300" wire:model="paciente">
            <input type="text" placeholder="Buscar Psicológo" class="mr-2 rounded-md border-gray-300" wire:model="psicologo">
            <input type="text" placeholder="Desde" class="mr-2 datetimepicker-input rounded-md border-gray-300" id="dateDesde" wire:model="from" readonly>
            <input type="text" placeholder="Hasta" class="mr-2 datetimepicker-input rounded-md border-gray-300" id="dateHasta" wire:model="to" readonly>
            <div class="flex items-stretch bg-gray-300 rounded-md">
                <span class="flex items-center rounded-md px-2">Total: </span>
                <input type="text" placeholder="Total" class="rounded-md border-gray-300" id="total" wire:model.defer="totalPagos" readonly>
            </div>
            
        </div>
    </div>

    @if ($pagos->count())
        <table class="min-w-full divide-y divide-gray-200 mt-3">
            <thead class="bg-gray-100">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                        Paciente
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                        Psicológo
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                        Fecha Pago
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                        Hora Pago
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                        Monto
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($pagos as $pago)
                    <tr>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">
                                {{$pago->paciente}}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">
                                {{$pago->psicologo}}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">
                                {{\Carbon\Carbon::parse($pago->fecha_pago)->format('d-m-Y')}}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">
                                {{\Carbon\Carbon::parse($pago->fecha_pago)->format('H:i:s')}}&nbsp;Horas
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">
                                ${{$pago->monto_pago}}
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="px-6 py-4 text-center">
            No existe ningún registro coincidente.
        </div>
    @endif

    @push('js')
    <script type="text/javascript">
        jQuery(function(){
            jQuery.datetimepicker.setLocale('es');
            jQuery('#dateDesde').datetimepicker({
                format: 'Y-m-d',
                onShow: function(ct){
                    this.setOptions({
                        maxDate: jQuery('#dateHasta').val()?jQuery('#dateHasta').val():false,
                    })
                },
                timepicker: false,
            }).on('change', function(e){
                console.log(jQuery('#dateDesde').val());
                @this.set('from', jQuery('#dateDesde').val());
            });
            jQuery('#dateHasta').datetimepicker({
                format: 'Y-m-d',
                onShow: function(ct){
                    this.setOptions({
                        minDate: jQuery('#dateDesde').val()?jQuery('#dateDesde').val():false
                    })
                },
                timepicker: false,
            });
        }).on('change', function(e){
            @this.set('to', jQuery('#dateHasta').val());
        });
    </script>
    @endpush
</div>