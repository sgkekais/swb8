@push('scripts')
    <script src="https://unpkg.com/trix@1.3.1/dist/trix.js"></script>
@endpush

<x-app-layout>
    <x-slot name="header">
        Impressum & Datenschutz
    </x-slot>
    <x-section class="mb-6">
        <div class="flex flex-col sm:flex-row items-center space-y-2 sm:space-x-3 sm:space-y-0">
            <a href="#impressum" class="w-full sm:w-auto">
                <x-button class="w-full sm:w-auto">
                    Impressum
                </x-button>
            </a>
            <a href="#datenschutz" class="w-full sm:w-auto">
                <x-button class="w-full sm:w-auto">
                    Datenschutz
                </x-button>
            </a>
            <a href="#quellenangaben" class="w-full sm:w-auto">
                <x-button class="w-full sm:w-auto">
                    Verwendete Medien
                </x-button>
            </a>
        </div>
    </x-section>
    <x-section id="impressum" class="mb-6">
        <x-headline class="text-2xl">
            Impressum
        </x-headline>
        @include('static._tos')

    </x-section>

    <x-section id="datenschutz" class="mb-6">
        <x-headline class="text-2xl">
            Datenschutzerklärung
        </x-headline>
        @include('static._data-privacy')

    </x-section>

    <x-section id="quellenangaben" class="mb-6">
        <x-headline class="text-2xl">
            Verwendete Medien
        </x-headline>
        <div>
            "Soccer at night" - Photo by <a class="inline-link" href="https://unsplash.com/@akeenster?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Abigail  Keenan</a> on <a class="inline-link" href="https://unsplash.com/@sgkekais/likes?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Unsplash</a>
        </div>
        <div>
            "people playing soccer on soccer field" - Photo by <a class="inline-link" href="https://unsplash.com/@misterwillsmith?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">William Smith</a> on <a class="inline-link" href="https://unsplash.com/@misterwillsmith?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Unsplash</a>
        </div>
        <div>
            Christoph Koeberlin’s “Libero” webfont
        </div>
    </x-section>
</x-app-layout>
