<div>
    {{-- Do your work, then step back. --}}
    <div class="text-sm font-sans italic" wire:poll.10000ms>
        "{{ $quote->quote }}" <span class="font-bold not-italic">&dash;{{ $quote->author }}</span>
    </div>
</div>
