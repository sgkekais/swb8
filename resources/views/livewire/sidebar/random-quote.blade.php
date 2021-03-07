<div>
    {{-- Do your work, then step back. --}}
    <div class="" wire:poll.15000ms>
        <x-load-indicator />
        <div class="" wire:loading.remove>
            <div class="">
                "{{ $quote->quote }}"
            </div>
            <div class="font-bold text-right">
                &dash;{{ $quote->author }}
            </div>
        </div>
    </div>
</div>
