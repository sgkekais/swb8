<div class="fixed z-10 inset-0 overflow-y-auto">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>

        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <div class="px-3 py-3 sm:px-6 bg-gray-200">
                @if($club_id)
                    ID: {{ $club_id }} bearbeiten
                @else
                    Neue Mannschaft anlegen
                @endif
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
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name_short">
                                Name - kurz
                            </label>
                            <input wire:model="name_short" id="name_short" type="text" placeholder="SW Bilk" class="admin-form-input" >
                        </div>
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name_code">
                                Code
                            </label>
                            <input wire:model="name_code" id="name_code" type="text" placeholder="SWB" class="admin-form-input">
                        </div>
                    </div>
                    <div class="mb-6 flex justify-start">
                        <div class="flex items-center mr-3">
                            <input wire:model="ah" id="ah" type="checkbox" class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out">
                            <label for="ah" class="ml-2 block leading-5 text-gray-900">
                                Altherren-Team?
                            </label>
                        </div>
                        <div class="flex items-center">
                            <input wire:model="owner" id="owner" type="checkbox" class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out">
                            <label for="owner" class="ml-2 block leading-5 text-gray-900">
                                Besitzer?
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
