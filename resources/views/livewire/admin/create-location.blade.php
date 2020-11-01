{{-- TODO: Modal als Komponente? --}}
<div>
    @include('admin.includes.alert')

    @if ($isOpen)
        <div class="fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

                <div class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>

                <!-- This element is to trick the browser into centering the modal contents. -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>

                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                    <div class="px-3 py-3 sm:px-6 bg-gray-200">
                        Neuen Standort anlegen
                    </div>
                    <form class="w-full max-w-lg">
                        <div class="p-3 sm:px-6">
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full px-3">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                                        Name
                                    </label>
                                    <input wire:model="name" id="name" type="text" class="admin-form-input" placeholder="Schwarz-Weiß Bilk '79'" required>
                                    @error('name')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full px-3">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name_short">
                                        Name - kurz
                                    </label>
                                    <input wire:model="name_short" id="name_short" type="text" placeholder="SW Bilk" class="admin-form-input" >
                                </div>
                            </div>
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full px-3">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="url">
                                        URL
                                    </label>
                                    <input wire:model="url" id="url" type="text" placeholder="SWB" class="admin-form-input">
                                    @error('url')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full px-3">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="url">
                                        Notizen
                                    </label>
                                    <textarea wire:model="note" id="note" class="admin-form-input">

                                    </textarea>
                                </div>
                            </div>
                            <div class="mb-6 flex justify-start">
                                <div class="flex items-center mr-3">
                                    <input wire:model="is_stadium" id="is_stadium" type="checkbox" class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out">
                                    <label for="is_stadium" class="ml-2 block leading-5 text-gray-900">
                                        Ist Fußballplatz?
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end bg-gray-100 p-3">
                            <button wire:click="closeModal()" type="button" class="btn btn-gray mr-2 px-4 py-2">
                                Abbrechen
                            </button>
                            <button wire:click.prevent="store()" type="button" class="btn btn-green px-4 py-2">
                                Speichern
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    @endif
    <!-- create a new location, opens modal -->
    <div class="mb-2 flex justify-center sm:justify-start">
        <span class="block shadow rounded-md">
            <button wire:click="create()" class="btn btn-blue px-4 py-2">
                Anlegen
            </button>
        </span>
    </div>
</div>
