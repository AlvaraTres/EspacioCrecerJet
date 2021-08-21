<nav x-data="{ open: false }" class="bg-green-600 border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex relative justify-between h-16">
            <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start ">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-jet-application-mark class="block h-9 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-4 sm-block sm:-my-px sm:ml-10 sm:flex items-center">

                   

                    @if (\Auth::user()->id_users_rol == 1)
                        <div class="flex">
                            <div x-data="{dropdownOpen: false}" class="relative my-32">
                                <button @click="dropdownOpen = !dropdownOpen"
                                    class="flex items-stretch relative z-10 rounded-md bg-green-600 p-2 focus:outline-none hover:bg-green-500"
                                    onClick="bgFunction(1)" id="usersnav">
                                    <p class="text-white">Usuarios</p>
                                    <svg class="h-5 w-5 items-center text-white" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 z-10">
                                </div>

                                <div x-show="dropdownOpen"
                                    class="absolute mt-2 py-2 bg-green-400 rounded-md shadow-xl z-20">
                                    <a href="{{ route('pacientes') }}"
                                        class="block px-4 py-2 text-sm capitalize text-gray-800 hover:bg-green-500 hover:text-white">
                                        Pacientes
                                    </a>
                                    <a href="{{ route('psicologos') }}"
                                        class="block px-4 py-2 text-sm capitalize text-gray-800 hover:bg-green-500 hover:text-white">
                                        Psicológos
                                    </a>
                                    <a href="{{ route('roles') }}"
                                        class="block px-4 py-2 text-sm capitalize text-gray-800 hover:bg-green-500 hover:text-white">
                                        Roles
                                    </a>
                                </div>

                            </div>
                        </div>

                        <x-jet-nav-link href="{{ route('reservas') }}" :active="request()->routeIs('reservas')">
                            Calendario Reservas
                        </x-jet-nav-link>

                        <x-jet-nav-link href="{{ route('horarios') }}"
                            :active="request()->routeIs('calendariohorarios')">
                            Calendario Horarios
                        </x-jet-nav-link>

                        <x-jet-nav-link href="{{ route('tags_trastornos') }}" :active="request()->routeIs('tags')">
                            Categorías Fichas
                        </x-jet-nav-link>

                        <x-jet-nav-link href="{{ route('pagos') }}" :active="request()->routeIs('pagos')">
                            Pagos
                        </x-jet-nav-link>
                        <div class="flex">
                            <div x-data="{dropdownOpen: false}" class="relative my-32">
                                <button @click="dropdownOpen = !dropdownOpen"
                                    class="flex items-stretch relative z-10 rounded-md bg-green-600 p-2 focus:outline-none hover:bg-green-500"
                                    onClick="bgFunction2(1)" id="reportsnav">
                                    <p class="text-white">Reportes</p>
                                    <svg class="h-5 w-5 items-center text-white" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 z-10">
                                </div>

                                <div x-show="dropdownOpen"
                                    class="absolute mt-2 py-2 bg-green-400 rounded-md shadow-xl z-20">
                                    <a href="{{ route('reportePagos') }}"
                                        class="block px-4 py-2 text-sm capitalize text-gray-800 hover:bg-green-500 hover:text-white">
                                        Reporte Pagos
                                    </a>
                                    <a href="{{ route('reporteReservas') }}"
                                        class="block px-4 py-2 text-sm capitalize text-gray-800 hover:bg-green-500 hover:text-white">
                                        Reporte Reservas
                                    </a>
                                    <a href="{{ route('reportePacientes') }}"
                                        class="block px-4 py-2 text-sm capitalize text-gray-800 hover:bg-green-500 hover:text-white">
                                        Reporte Pacientes
                                    </a>
                                    <a href="{{ route('reporteCategorias') }}"
                                        class="block px-4 py-2 text-sm capitalize text-gray-800 hover:bg-green-500 hover:text-white">
                                        Reporte Categorías
                                    </a>
                                </div>

                            </div>
                        </div>
                    @else
                        @if (\Auth::user()->id_users_rol == 2)
                            <x-jet-nav-link href="{{ route('pacientes') }}" :active="request()->routeIs('pacientes')">
                                Mis Pacientes
                            </x-jet-nav-link>
                            <x-jet-nav-link href="{{ route('reservas') }}" :active="request()->routeIs('reservas')">
                                Mi Calendario de Reservas
                            </x-jet-nav-link>
                            <x-jet-nav-link href="{{ route('horarios') }}"
                                :active="request()->routeIs('calendariohorarios')">
                                Mi Calendario Horarios
                            </x-jet-nav-link>
                            <x-jet-nav-link href="{{ route('pagos') }}" :active="request()->routeIs('pagos')">
                                Mis Pagos
                            </x-jet-nav-link>
                            <div class="flex">
                                <div x-data="{dropdownOpen: false}" class="relative my-32">
                                    <button @click="dropdownOpen = !dropdownOpen"
                                        class="flex items-stretch relative z-10 rounded-md bg-green-600 p-2 focus:outline-none hover:bg-green-500"
                                        onClick="bgFunction2(1)" id="reportsnav">
                                        <p class="text-white">Reportes</p>
                                        <svg class="h-5 w-5 items-center text-white" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>

                                    <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 z-10">
                                    </div>

                                    <div x-show="dropdownOpen"
                                        class="absolute mt-2 py-2 bg-green-400 rounded-md shadow-xl z-20">
                                        <a href="{{ route('reporteReservas') }}"
                                            class="block px-4 py-2 text-sm capitalize text-gray-800 hover:bg-green-500 hover:text-white">
                                            Reporte Reservas
                                        </a>
                                        <a href="{{ route('reporteCategorias') }}"
                                            class="block px-4 py-2 text-sm capitalize text-gray-800 hover:bg-green-500 hover:text-white">
                                            Reporte Categorías
                                        </a>
                                    </div>

                                </div>
                            </div>
                        @else
                            @if (\Auth::user()->id_users_rol == 3)
                                <x-jet-nav-link href="{{ route('reservas') }}"
                                    :active="request()->routeIs('reservas')">
                                    Calendario Reservas
                                </x-jet-nav-link>
                                <x-jet-nav-link href="{{ route('horarios') }}"
                                    :active="request()->routeIs('horarios')">
                                    Horarios de Atención
                                </x-jet-nav-link>
                                <x-jet-nav-link href="{{ route('misPagos') }}"
                                    :active="request()->routeIs('misPagos')">
                                    Mis Pagos
                                </x-jet-nav-link>
                            @endif
                        @endif
                    @endif




                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Teams Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="ml-3 relative">
                        <x-jet-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition">
                                        {{ Auth::user()->currentTeam->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>

                            <x-slot name="content">
                                <div class="w-60">
                                    <!-- Team Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Team') }}
                                    </div>

                                    <!-- Team Settings -->
                                    <x-jet-dropdown-link
                                        href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                        {{ __('Team Settings') }}
                                    </x-jet-dropdown-link>

                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-jet-dropdown-link href="{{ route('teams.create') }}">
                                            {{ __('Create New Team') }}
                                        </x-jet-dropdown-link>
                                    @endcan

                                    <div class="border-t border-gray-100"></div>

                                    <!-- Team Switcher -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Switch Teams') }}
                                    </div>

                                    @foreach (Auth::user()->allTeams() as $team)
                                        <x-jet-switchable-team :team="$team" />
                                    @endforeach
                                </div>
                            </x-slot>
                        </x-jet-dropdown>
                    </div>
                @endif

                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button
                                    class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="h-8 w-8 rounded-full object-cover"
                                        src="{{ Auth::user()->profile_photo_url }}"
                                        alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                        {{ Auth::user()->nombre_usuario }}&nbsp;{{ Auth::user()->apellido_pat_usuario }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Administrar Cuenta') }}
                            </div>

                            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Perfil') }}
                            </x-jet-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-jet-dropdown-link>
                            @endif

                            <div class="border-t border-gray-100"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-jet-dropdown-link href="{{ route('logout') }}" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Salir') }}
                                </x-jet-dropdown-link>
                            </form>
                        </x-slot>
                    </x-jet-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <!-- Responsive Navigation Menu -->

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @if (\Auth::user()->id_users_rol == 1)
                <div @click.away="open = false" class="relative" x-data="{ open: false }">
                    <button @click="open = !open"
                        class="flex flex-row items-center w-full rounded-md bg-green-600 p-2 focus:outline-none hover:bg-green-500">
                        <span class="text-white">Usuarios</span>
                        <svg fill="white" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}"
                            class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <div x-show="open" x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg md:w-48">
                        <div class="px-2 py-2 bg-white rounded-md shadow dark-mode:bg-gray-800">
                            <a class="block px-4 py-2 text-sm capitalize text-gray-800 hover:bg-green-500 hover:text-white"
                                href="{{ route('pacientes') }}">Pacientes</a>
                            <a class="block px-4 py-2 text-sm capitalize text-gray-800 hover:bg-green-500 hover:text-white"
                                href="{{ route('psicologos') }}">Psicológos</a>
                            <a class="block px-4 py-2 text-sm capitalize text-gray-800 hover:bg-green-500 hover:text-white"
                                href="{{ route('roles') }}">Roles</a>
                        </div>
                    </div>
                </div>
                <x-jet-responsive-nav-link href="#" :active="request()->routeIs('calendarioreservas')"
                    class="hover:bg-green-500">
                    Calendario Reservas
                </x-jet-responsive-nav-link>
                <x-jet-responsive-nav-link href="{{ route('horarios') }}"
                    :active="request()->routeIs('calendariohorarios')" class="hover:bg-green-500">
                    Calendario Horarios
                </x-jet-responsive-nav-link>
                <x-jet-responsive-nav-link href="#" :active="request()->routeIs('tags')" class="hover:bg-green-500">
                    Categorías
                </x-jet-responsive-nav-link>
                <x-jet-responsive-nav-link href="#" :active="request()->routeIs('pagos')" class="hover:bg-green-500">
                    Pagos
                </x-jet-responsive-nav-link>
                <div @click.away="open = false" class="relative" x-data="{ open: false }">
                    <button @click="open = !open"
                        class="flex flex-row items-center w-full rounded-md bg-green-600 p-2 focus:outline-none hover:bg-green-500">
                        <span class="text-white">Reportes</span>
                        <svg fill="white" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}"
                            class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <div x-show="open" x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg md:w-48">
                        <div class="px-2 py-2 bg-white rounded-md shadow dark-mode:bg-gray-800">
                            <a href="{{ route('reportePagos') }}"
                                class="block px-4 py-2 text-sm capitalize text-gray-800 hover:bg-green-500 hover:text-white">
                                Reporte Pagos
                            </a>
                            <a href="{{ route('reporteReservas') }}"
                                class="block px-4 py-2 text-sm capitalize text-gray-800 hover:bg-green-500 hover:text-white">
                                Reporte Reservas
                            </a>
                            <a href="{{ route('reportePacientes') }}"
                                class="block px-4 py-2 text-sm capitalize text-gray-800 hover:bg-green-500 hover:text-white">
                                Reporte Pacientes
                            </a>
                            <a href="{{ route('reporteCategorias') }}"
                                class="block px-4 py-2 text-sm capitalize text-gray-800 hover:bg-green-500 hover:text-white">
                                Reporte Categorías
                            </a>
                        </div>
                    </div>
                </div>
            @else
                @if (\Auth::user()->id_users_rol == 2)
                    <x-jet-responsive-nav-link href="{{ route('pacientes') }}"
                        :active="request()->routeIs('pacientes')" class="hover:bg-green-500">
                        Mis Pacientes
                    </x-jet-responsive-nav-link>
                    <x-jet-responsive-nav-link href="{{ route('reservas') }}"
                        :active="request()->routeIs('reservas')" class="hover:bg-green-500">
                        Mi Calendario de Reservas
                    </x-jet-responsive-nav-link>
                    <x-jet-responsive-nav-link href="{{ route('horarios') }}"
                        :active="request()->routeIs('horarios')" class="hover:bg-green-500">
                        Mi Calendario Horarios
                    </x-jet-responsive-nav-link>
                    <x-jet-responsive-nav-link href="{{ route('pagos') }}" :active="request()->routeIs('pagos')"
                        class="hover:bg-green-500">
                        Mis Pagos
                    </x-jet-responsive-nav-link>
                    <div @click.away="open = false" class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="flex flex-row items-center w-full rounded-md bg-green-600 p-2 focus:outline-none hover:bg-green-500">
                            <span class="text-white">Reportes</span>
                            <svg fill="white" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}"
                                class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg md:w-48">
                            <div class="px-2 py-2 bg-white rounded-md shadow dark-mode:bg-gray-800">
                                <a href="{{ route('reporteReservas') }}"
                                    class="block px-4 py-2 text-sm capitalize text-gray-800 hover:bg-green-500 hover:text-white">
                                    Reporte Reservas
                                </a>
                                <a href="{{ route('reporteCategorias') }}"
                                    class="block px-4 py-2 text-sm capitalize text-gray-800 hover:bg-green-500 hover:text-white">
                                    Reporte Categorías
                                </a>
                            </div>
                        </div>
                    </div>
                @else

                    <x-jet-responsive-nav-link href="#" :active="request()->routeIs('calendarioreservas')"
                        class="hover:bg-green-500">
                        Calendario Reservas
                    </x-jet-responsive-nav-link>
                    <x-jet-responsive-nav-link href="{{ route('horarios') }}"
                        :active="request()->routeIs('calendariohorarios')" class="hover:bg-green-500">
                        Calendario Horarios
                    </x-jet-responsive-nav-link>
                    <x-jet-responsive-nav-link href="{{ route('misPagos') }}" class="hover:bg-green-500"
                        :active="request()->routeIs('misPagos')" class="hover:bg-green-500">
                        Mis Pagos
                    </x-jet-responsive-nav-link>
                @endif

            @endif

        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="flex-shrink-0 mr-3">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                            alt="{{ Auth::user()->nombre_usuario }}" />
                    </div>
                @endif

                <div>
                    <div class="font-medium text-base text-gray-400">{{ Auth::user()->nombre_usuario }}</div>
                    <div class="font-medium text-sm text-gray-300">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-jet-responsive-nav-link class="hover:bg-green-500" href="{{ route('profile.show') }}"
                    :active="request()->routeIs('profile.show')">
                    {{ __('Perfil') }}
                </x-jet-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}"
                        :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-jet-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-jet-responsive-nav-link class="hover:bg-green-500" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    this.closest('form').submit();">
                        {{ __('Salir') }}
                    </x-jet-responsive-nav-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="border-t border-gray-200"></div>

                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Team') }}
                    </div>

                    <!-- Team Settings -->
                    <x-jet-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}"
                        :active="request()->routeIs('teams.show')">
                        {{ __('Team Settings') }}
                    </x-jet-responsive-nav-link>

                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <x-jet-responsive-nav-link href="{{ route('teams.create') }}"
                            :active="request()->routeIs('teams.create')">
                            {{ __('Create New Team') }}
                        </x-jet-responsive-nav-link>
                    @endcan

                    <div class="border-t border-gray-200"></div>

                    <!-- Team Switcher -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Switch Teams') }}
                    </div>

                    @foreach (Auth::user()->allTeams() as $team)
                        <x-jet-switchable-team :team="$team" component="jet-responsive-nav-link" />
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    @push('js')
        <script type="text/javascript">
            var count = 0;

            function bgFunction(x) {
                var x;
                if (x == 1) {
                    count = count + 1;
                }
                if (count == 1) {
                    document.getElementById("usersnav").style.backgroundColor = "rgb(5, 150, 105)";
                } else if (count == 2) {
                    document.getElementById("usersnav").style.backgroundColor = "rgb(6, 78, 59)";
                    count = 0;
                }
            }

            if (window.location.href == "{{ route('pacientes') }}" || window.location.href ==
                "{{ route('psicologos') }}") {
                document.getElementById("usersnav").style.backgroundColor = "rgb(5, 150, 105)";
            }

            const closeclick = document.querySelector("#usersnav");

            document.addEventListener("click", function(event) {
                if (!event.target.closest("#usersnav")) {
                    document.getElementById("usersnav").style.backgroundColor = "rgb(6, 78, 59)";
                    count = 0;
                }
            });
        </script>

        <script type="text/javascript">
            var count2 = 0;

            function bgFunction2(y) {
                var y;
                if (y == 1) {
                    count2 = count2 + 1;
                }
                if (count2 == 1) {
                    document.getElementById("reportsnav").style.backgroundColor = "rgb(5, 150, 105)";
                } else if (count == 2) {
                    document.getElementById("reportsnav").style.backgroundColor = "rgb(6, 78, 59)";
                    count2 = 0;
                }
            }
            if (window.location.href == "{{ route('reportePagos') }}" || window.location.href ==
                "{{ route('reportePacientes') }}" || window.location.href == "{{ route('reporteReservas') }}") {
                document.getElementById("reportsnav").style.backgroundColor = "rgb(5, 150, 105)";
            }

            const closeclick2 = document.querySelector("#reportsnav");

            document.addEventListener("click", function(event) {
                if (!event.target.closest("#reportsnav")) {
                    document.getElementById("reportsnav").style.backgroundColor = "rgb(6, 78, 59)";
                    count = 0;
                }
            });
        </script>
    @endpush
</nav>
