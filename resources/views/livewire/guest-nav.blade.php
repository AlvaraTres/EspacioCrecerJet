<nav class="bg-blue-300" x-data="{ open: false }">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="relative flex items-center justify-between h-16">

            <!-- Menú mobile botón menú mobile -->
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <!-- Mobile menu button-->
                <button x-on:click="open = true" type="button"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Abrir menú</span>
                    <!--
              Icon when menu is closed.
  
              Heroicon name: outline/menu
  
              Menu open: "hidden", Menu closed: "block"
            -->
                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <!--
              Icon when menu is open.
  
              Heroicon name: outline/x
  
              Menu open: "block", Menu closed: "hidden"
            -->
                    <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">

                <!-- logotipo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="/" class="flex items-stretch">
                        <img class=" lg:block h-10 w-auto flex items-center" src="{{ asset('images/LogoEspacioCrecersinfondo.svg') }}"
                        alt="Espacio Crecer">
                        <h2 class="flex items-center mt-2 lg:block text-left text-white font-sans">Espacio Crecer</h2></a>
                </div>
            </div>

            <!--  -->
            <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">

                <!-- botón de notificación -->


                <a href="{{ route('login') }}"
                    class="text-white hover:bg-blue-500 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Iniciar
                    Sesión</a>
                <a href="{{ route('register') }}"
                    class="text-white hover:bg-blue-500 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Registrarse</a>




            </div>

        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="sm:hidden" id="mobile-menu" x-show="open" x-on:click.away="open = false">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
            <a href="#" class="bg-blue-900 text-white block px-3 py-2 rounded-md text-base font-medium"
                aria-current="page">Inicio</a>


        </div>
    </div>
</nav>
