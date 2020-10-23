<div class="fixed z-10 inset-0 overflow-y-auto">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>

        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <div class="px-3 py-3 sm:px-6 bg-gray-200 text-red-600">
                Mannschaft mit der <span class="font-bold">ID {{ $club_id }}</span> wirklich löschen?
            </div>
            <div class="px-3 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <form class="w-full max-w-lg">            
                    <div class="flex justify-end">                                                
                        <button wire:click="closeDeleteModal()" type="button" class="btn btn-gray mr-2">
                            Abbrechen
                        </button>
                        <button wire:click.prevent="destroy({{ $club_id }})" type="button" class="btn btn-red ">
                            Löschen
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
