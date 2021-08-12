<x-app-layout>
        <div class="py-12">
            <div class="mx-auto sm:px-6 lg:px-8 flex items-stretch">
                
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    @livewire('show-reservas-report')
                </div>

                <div class="bg-white flex-grow overflow-hidden shadow-xl sm:rounded-lg ml-3">
                    @livewire('show-reservas-report-psicologos')
                </div>

            </div>
        </div>
</x-app-layout>
