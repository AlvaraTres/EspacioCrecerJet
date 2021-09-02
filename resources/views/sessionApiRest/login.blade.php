<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pb-20 sm:pt-0" style="background-image: url(images/logo_opacidad_40.png); overflow: hidden; background-size: auto; background-position: center;">
        <div class="bg-green-500 sm:max-w-md shadow-md w-full overflow-hidden sm:rounded-lg">
            <p class="font-bold text-white text-center mt-2 text-lg h-2">Iniciar Sesión</p>
            <div class="w-full bg-gray-50 sm:max-w-md mt-6 px-6 py-4 shadow-md overflow-hidden sm:rounded-b-lg"
                >
                <form method="POST" action="#" style="background-image: {{asset('images/logo_opacidad_40.png')}}">
                    @csrf
                    
                    @error('message')
                        <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-600 p-2 my-2">*Error</p>
                    @enderror
                    <div>
                        <x-jet-label for="Correo" value="{{ __('Email') }}"/>
                        <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                    </div>
                    
                    <div class="mt-4">
                        <x-jet-label for="Contraseña" value="{{ __('Password') }}" />
                        <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                    </div>
                    
                    <div class="block mt-4">
                        <label for="Recordarme" class="flex items-center">
                            <x-jet-checkbox id="remember_me" name="remember" />
                            <span class="ml-2 text-sm text-gray-600">{{ __('Recordarme') }}</span>
                        </label>
                    </div>
                    
                    <div class="flex items-center justify-end mt-4">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="">
                            {{ __('¿Olvidaste tu contraseña?') }}
                        </a>

                        <button type="submit" class="ml-4 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest bg-green-700 hover:bg-green-600 active:bg-green-900 focus:outline-none focus:border-gray-900 focus:ring-gray-300 disabled:opacity-25 transition">
                            {{ __('Ingresar') }}
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
    </script>
</x-guest-layout>