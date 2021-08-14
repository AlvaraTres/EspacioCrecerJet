<x-app-layout>
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8 flex items-stretch">

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg @if(\Auth::user()->id_users_rol == 2) w-full @endif">
                @livewire('show-reservas-report')
            </div>

            @if (\Auth::user()->id_users_rol == 1)
                <div class="bg-white flex-grow overflow-hidden shadow-xl sm:rounded-lg ml-3">
                    @livewire('show-reservas-report-psicologos')
                </div>
            @endif


        </div>
        <div class="mx-auto sm:px-6 lg:px-8 py-5">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @livewire('show-horas-reservas-report')
            </div>
        </div>
    </div>
</x-app-layout>
