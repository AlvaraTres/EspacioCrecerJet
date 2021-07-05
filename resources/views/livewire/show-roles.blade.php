<div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 bg-gray-200">
        <div class="px-6 py-4 flex items-stretch bg-gray-300">
            <span
                class="flex items-center bg-blue-200 leading-normal rounded rounded-r-none border border-r-0 border-black px-3 text-grey-dark whitespace-no-wrap ">Buscar</span>
            <input type="text"
                class="flex-shrink flex-grow w-px leading-normal rounded rounded-l-none px-3 relative focus:border-blue focus:shadow border border-black mr-4"
                placeholder="Tipo usuario" wire:model="search">
            @livewire('create-rol')
        </div>

    </div>

    @if ($rols->count())
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                        wire:click="order('id')">
                        ID
                        @if ($sort == 'id')
                            @if ($direction == 'asc')
                                <i class="fas fa-sort-numeric-up float-right mt-1"></i>
                            @else
                                <i class="fas fa-sort-numeric-down-alt float-right mt-1"></i>
                            @endif

                        @else
                            <i class="fas fa-sort float-right mt-1"></i>
                        @endif
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                        wire:click="order('tipo_usuario')">
                        NOMBRE ROL
                        @if ($sort == 'tipo_usuario')
                            @if ($direction == 'asc')
                                <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                            @else
                                <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                            @endif

                        @else
                            <i class="fas fa-sort float-right mt-1"></i>
                        @endif
                    </th>
                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($rols as $rol)
                    <tr>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">
                                {{ $rol->id }}
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            <div class="text-sm text-gray-900">
                                {{ $rol->tipo_usuario }}
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right text-sm font-medium">
                            <a href="#" class="inline-flex items-center justify-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 focus:outline-none focus:border-yellow-700 focus:ring focus:ring-yellow-200 active:bg-yellow-600 disabled:opacity-25 transition'" wire:click="edit({{$rol->id}})">Editar</a>
                            <a href="#" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition'" wire:click="delete({{$rol->id}})">Eliminar</a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

    {{ $rols->links() }}

    @else
        <div class="px-6 py-4 text-center">
            No existe ningún registro coincidente.
        </div>
    @endif


    <!-- Modal de Edición -->
    <x-jet-dialog-modal wire:model="openEditModal">
        <x-slot name="title">
            Editar Rol
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label value="Nombre Rol:" />
                <x-jet-input id="tipo_usuario" type="text" class="text-black mt-1 block w-full" wire:model.defer="tipo_usuario"  />
                <x-jet-input-error for="tipo_usuario" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="updateRol" wire:loading.attr="disabled" class="disabled:opacity-25">Editar Rol</x-jet-secondary-button>
            <x-jet-danger-button wire:click="$set('openEditModal', false)" wire:loading.attr="disabled" class="disabled:opacity-25">Cancelar</x-jet-danger-button>
        </x-slot>

    </x-jet-dialog-modal>

    <!-- Modal de Eliminación -->
    <x-jet-dialog-modal wire:model="openDeleteModal">
        <x-slot name="title">
            Eliminar Rol
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <p id="tipo_usuario" wire:model.defer="tipo_usuario">¿Estás seguro de eliminar este rol?</p>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="destroyRol" wire:loading.attr="disabled" class="disabled:opacity-25">Eliminar Rol</x-jet-secondary-button>
            <x-jet-danger-button wire:click="$set('openDeleteModal', false)" wire:loading.attr="disabled" class="disabled:opacity-25">Cancelar</x-jet-danger-button>
        </x-slot>

    </x-jet-dialog-modal>
</div>
