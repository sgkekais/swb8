<div>
    {{-- Do your work, then step back. --}}
    <div class="font-sans italic" wire:poll.1000>
        "{{ $quote->quote }}" <span class="font-bold not-italic">&dash;{{ $quote->author }}</span>
    </div>
</div>
