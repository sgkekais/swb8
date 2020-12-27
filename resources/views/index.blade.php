<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Front') }}
        </h2>
    </x-slot>
    @php
        $date = \App\Models\Date::find(665)->load('dateOptions.users');
    @endphp
    <div class="min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <livewire:poll :date="$date" />
        </div>
    </div>
</x-app-layout>
