<div wire:poll.15000ms class="w-full">
    <x-load-indicator />
    <div class="flex flex-col" wire:loading.remove>
        <div class="flex-1">
            "{{ $quote->quote }}"
        </div>
        <div class="flex-1 font-bold text-right">
            &dash;{{ $quote->author }}
        </div>
    </div>
</div>
