@props(['id' => null, 'maxWidth' => null])

<x-jet-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="">
        <div class="w-full bg-gray-100 px-6 py-4 text-lg">
            {{ $title }}
        </div>

        <div class="mt-4 px-6 py-4">
            {{ $content }}
        </div>
    </div>

    <div class="px-6 py-4 bg-gray-100 text-right">
        {{ $footer }}
    </div>
</x-jet-modal>
