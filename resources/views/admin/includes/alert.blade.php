@if (session()->has('success'))
    <div class="mb-4 border-l-4 border-green-500 shadow-xl sm:rounded-lg" role="alert" x-data="{ show: true }" x-show="show">
        <div class="flex w-full rounded-t p-2 bg-white text-green-700 font-bold justify-between">
            <span class="flex">
                Erfolg
            </span>
            <button type="button" class="flex" x-on:click="show = false">
                X
            </button>
        </div>
        <div class="flex w-full rounded-b p-2 bg-gray-100">
            {{ session('success') }}
        </div>
    </div>
@endif
