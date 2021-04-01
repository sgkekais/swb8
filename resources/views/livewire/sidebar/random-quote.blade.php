<div wire:poll.15000ms class="w-full p-4">
    <x-load-indicator />
    <div class="flex flex-col space-y-2" wire:loading.remove>
        <div class="flex flex-1">
            <div class="text-5xl text-gray-500 ">&ldquo;</div>
            <div class="flex-1">{{ $quote->quote }}</div>
{{--            <div class="flex items-end text-5xl text-gray-500 ">&bdquo;</div>--}}
        </div>
        <div class="flex-1 font-bold text-right">
            &mdash;{{ $quote->author }}
        </div>
    </div>
</div>
