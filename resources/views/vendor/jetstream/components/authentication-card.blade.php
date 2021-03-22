<div class="min-h-screen flex flex-col justify-center items-center"
    style="background-image: url('img/bg-3.jpg'); background-position: bottom; background-size: cover; background-repeat: no-repeat">
    <div class="-mt-10">
        {{ $logo }}
    </div>
    <div class="relative w-10/12 sm:max-w-md mt-6">
        <div class="absolute bg-primary-600 top-0.5 -right-0.5 -bottom-0.5 left-0.5" style="transform-origin: 50% 50% 0px;border-radius: 0%;"></div>
        <div class="relative p-4 bg-white border border-black">
            {{ $slot }}
        </div>
    </div>
</div>
