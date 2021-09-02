<x-guest-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="min-h-screen flex flex-col sm:justify-center items-center pb-20 sm:pt-0"
                    style="background-image: url(images/logo_opacidad_40.png); overflow: hidden; background-size: auto; background-position: center;">

                    <div class="bg-green-500 sm:max-w-md shadow-md w-full overflow-hidden sm:rounded-lg">
                        <p class="font-bold text-white text-center mt-2 text-lg h-2">Contáctanos</p>
                        <form method="POST" action="{{ route('contactanos') }}" enctype="multipart/form-data">
                            @csrf
                        <div
                            class="w-full bg-gray-50 sm:max-w-md mt-6 px-6 py-4 shadow-md overflow-hidden sm:rounded-b-lg">
                            
                            <div class="mt-4">
                                <x-jet-label for="Nombre" value="{{ __('Nombre') }}" />
                                <x-jet-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" :value="old('nombre')" required autofocus />
                            </div>

                            <div class="mt-4">
                                <x-jet-label for="apellidos" value="{{ __('Apellidos') }}" />
                                <x-jet-input id="apellidos" class="block mt-1 w-full" type="text" name="apellidos" :value="old('apellidos')" required autofocus />
                            </div>

                            <div class="mt-4">
                                <x-jet-label for="correo" value="{{ __('Correo') }}" />
                                <x-jet-input id="correo" class="block mt-1 w-full" type="email" name="correo" :value="old('correo')" required autofocus />
                            </div>

                            <div class="mt-4">
                                <x-jet-label for="telefono" value="{{ __('Teléfono') }}" />
                                <div class="flex items-stretch">
                                    <span class="flex items-center bg-grey-200 leading-normal rounded rounded-r-none border border-r-0 border-gray-300   px-2 text-grey-dark whitespace-no-wrap ">+56</span>
                                    <input type="text" class="flex items-center leading-normal rounded rounded-l-none relative focus:border-indigo-300 focus:shadow border border-gray-300 w-full focus:ring focus:ring-indigo-200 focus:ring-opacity-50 shadow-sm" name="telefono" id="telefono" :value="old('telefono')" required autofocus autocomplete="telefono">
                                </div>
                            </div>

                            <div class="mt-4">
                                <x-jet-label for="comentario" value="{{ __('Comentario') }}" />
                                <textarea class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="comentario" id="comentario" rows="10" required autofocus value="old('comentario')"></textarea>
                            </div>
                            <div class="flex items-center justify-end mt-4">
                                <x-jet-button class="ml-4 bg-blue-600 hover:bg-blue-500">
                                    {{ __('Enviar') }}
                                </x-jet-button>
                            </div>
                        </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-guest-layout>