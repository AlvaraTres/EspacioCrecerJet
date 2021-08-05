<div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 bg-gray-200">
        <div class="px-6 py-4 flex items-stretch bg-gray-300">
            <span
                class="flex items-center bg-blue-200 leading-normal rounded rounded-r-none border border-r-0 border-black px-3 text-grey-dark whitespace-no-wrap ">Buscar</span>
            <input type="text"
                class="flex-shrink flex-grow w-px leading-normal rounded rounded-l-none px-3 relative focus:border-blue focus:shadow border border-black mr-4"
                placeholder="Buscar Tag" wire:model="search">
            @livewire('create-tag')
        </div>
    </div>

    @if ($tags->count())
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
                        wire:click="order('nombre_tag')">
                        NOMBRE
                        @if ($sort == 'nombre_tag')
                            @if ($direction == 'asc')
                                <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                            @else
                                <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                            @endif

                        @else
                            <i class="fas fa-sort float-right mt-1"></i>
                        @endif
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                        wire:click="order('descripcion')">
                        DESCRIPCIÓN
                        @if ($sort == 'descripcion')
                            @if ($direction == 'asc')
                                <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                            @else
                                <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                            @endif

                        @else
                            <i class="fas fa-sort float-right mt-1"></i>
                        @endif
                    </th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Acción
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($tags as $tag)
                    <tr>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">
                                {{ $tag->id }}
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            <div class="text-sm text-gray-900">
                                {{ $tag->nombre_tag }}
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            <div class="text-sm text-gray-900">
                                {{ $tag->descripcion }}
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right text-sm font-medium flex items-stretch">
                            <a href="#" class="inline-flex items-center justify-center px-4 py-2 mr-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 focus:outline-none focus:border-yellow-700 focus:ring focus:ring-yellow-200 active:bg-yellow-600 disabled:opacity-25 transition'" wire:click="editTag({{$tag->id}})">Editar</a>
                            <a href="#" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition'" wire:click="deleteTag({{$tag->id}})">Eliminar</a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

    {{ $tags->links() }}

    @else
        <div class="px-6 py-4 text-center">
            No existe ningún registro coincidente.
        </div>
    @endif

    <!-- UPDATE MODAL -->
    <x-jet-dialog-modal wire:model="openEditTagModal">
        <x-slot name="title">
            Editar Tag Trastorno Mental
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label value="Nombre Tag:"/>
                <x-jet-input type="text" class="w-full" wire:model.defer="nombre_tag"/>
                
                <x-jet-input-error for="nombre_tag"/>

            </div>
            <div class="mb-4">
                <x-jet-label value="Descripción:"/>
                <x-jet-input type="text" class="w-full" wire:model.defer="descripcion"/>
                
                <x-jet-input-error for="descripcion"/>

            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="updateTag" wire:loading.attr="disabled" class="disabled:opacity-25">Editar Tag</x-jet-secondary-button>
            <x-jet-danger-button wire:click="$set('openEditTagModal', false)" wire:loading.attr="disabled" class="disabled:opacity-25">Cancelar</x-jet-danger-button>
        </x-slot>

    </x-jet-dialog-modal>

    <!-- DELETE MODAL -->
    <x-jet-dialog-modal wire:model="openDeleteTagModal">
        <x-slot name="title">
            Eliminar Tag Trastorno Mental
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <p id="nombre_tag" wire:model.defer="nombre_tag">¿Estás seguro de eliminar este tag trastorno mental?</p>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="destroyTag" wire:loading.attr="disabled" class="disabled:opacity-25">Eliminar Tag</x-jet-secondary-button>
            <x-jet-danger-button wire:click="$set('openDeleteTagModal', false)" wire:loading.attr="disabled" class="disabled:opacity-25">Cancelar</x-jet-danger-button>
        </x-slot>

    </x-jet-dialog-modal>
</div>
