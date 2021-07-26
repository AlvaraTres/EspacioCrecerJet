<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" flex flex-col  items-center sm:pt-0 bg-blue-500 overflow-hidden shadow-xl sm:rounded-lg">
                
                <div class="bg-blue-500  shadow-md w-full overflow-hidden sm:rounded-lg">
                    <p class="font-bold text-white text-center mt-2 text-lg h-2">Felicidades!</p>
                    <div class="w-full mt-6 px-6 py-4 shadow-md overflow-hidden sm:rounded-lg bg-white">
                        @foreach ($datos as $item)
                            Hola {{$item->nombre_paciente}}&nbsp;{{$item->ap_pat_paciente}}&nbsp;{{$item->ap_mat_paciente}}, hemos registrado con éxito tu reserva de hora con el psicológo {{$item->nombre_usuario}}&nbsp;{{$item->apellido_pat_usuario}}&nbsp;{{$item->apellido_mat_usuario}} para el dia {{\Carbon\Carbon::parse($item->fecha_hora_reserva)->format('d-m-Y')}} a las {{ \Carbon\Carbon::parse($item->fecha_hora_reserva)->format('H:i')}} horas via Zoom. Pronto te haremos llegar un correo a {{$item->correo}} con toda la información de tu reunión.
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>