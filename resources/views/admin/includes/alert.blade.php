@if (session()->has('success'))
    <div class="relative" role="alert" x-data="{ show: true }" x-show="show">
        <div class="absolute bg-primary-600 top-0.5 -right-0.5 -bottom-0.5 left-0.5" style="transform-origin: 50% 50% 0px;border-radius: 0%;"></div>
        <div class="relative mb-4 border border-black" >
            <div class="flex w-full p-2 bg-primary-600 text-white font-bold justify-between">
            <span class="flex items-center">
                <i class="fas fa-fw fa-check-circle pr-2"></i> Erfolg
            </span>
                <button type="button" class="flex font-sans font-extrabold" x-on:click="show = false">
                    X
                </button>
            </div>
            <div class="flex w-full p-2 bg-white">
                {{ session('success') }}
            </div>
        </div>
    </div>
@endif
