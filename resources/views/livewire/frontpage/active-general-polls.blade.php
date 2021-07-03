<div>
    @if ($active_polls->count() > 0 && auth()->user()->dateOptions()->whereIn('date_id', $active_polls->pluck('id'))->count() == 0)
        <div class="pt-2">
            <x-box-with-shadow class="p-2" shadow-color="bg-gray-600">
                <div class="flex items-center space-x-2">
                    <div>
                        <i class="fas fa-calendar-day text-indigo-600" title="Umfrage"></i>
                    </div>
                    <div>
                        Es gibt <span class="font-bold text-indigo-600">{{ $active_polls->count() }}</span> Umfrage{{ $active_polls->count() > 1 ? "n" : null }} im <a href="{{ route('calendar') }}" class="inline-link">Kalender</a>, an {{ $active_polls->count() > 1 ? "denen" : "der" }} du noch nicht teilgenommen hast!
                    </div>
                </div>
            </x-box-with-shadow>
        </div>
    @endif
</div>
