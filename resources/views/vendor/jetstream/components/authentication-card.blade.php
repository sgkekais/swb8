<div class="min-h-screen flex flex-col justify-center items-center relative"
    style="background-image: url('img/bg-3.jpg'); background-position: bottom; background-size: cover; background-repeat: no-repeat">
    <div class="absolute bottom-0 right-0 p-4 text-sm text-white text-right">
        "Soccer at night" - Photo by <a class="inline-link" href="https://unsplash.com/@akeenster?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Abigail  Keenan</a> on <a class="inline-link" href="https://unsplash.com/@sgkekais/likes?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Unsplash</a>
    </div>
    <div class="-mt-10 relative">
        {{ $logo }}
    </div>
    <div class="relative w-10/12 sm:max-w-md mt-6">
        <div class="absolute bg-primary-600 top-0.5 -right-0.5 -bottom-0.5 left-0.5" style="transform-origin: 50% 50% 0px;border-radius: 0%;"></div>
        <div class="relative p-4 bg-white border border-black">
            {{ $slot }}
        </div>
    </div>
</div>
