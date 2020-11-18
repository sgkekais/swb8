<div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow sm:rounded-lg">
            <div class="text-sm p-2">
                {{ $log_entries->links('livewire.admin.pagination') }}
            </div>
            <table class="min-w-full divide-y divide-gray-200 border-t border-b border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-2 text-left text-sm font-bold text-gray-500 uppercase tracking-wider">Log ID</th>
                        <th class="p-2 text-left text-sm font-bold text-gray-500 uppercase tracking-wider">User</th>
                        <th class="p-2 text-left text-sm font-bold text-gray-500 uppercase tracking-wider">&nbsp;</th>
                        <th class="w-1/2 p-2 text-left text-sm font-bold text-gray-500 uppercase tracking-wider">Änderung</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($log_entries as $log_entry)
                        <tr class="{{ $loop->even ? "bg-gray-50" : null}} hover:bg-gray-100">
                            <td class="p-2 text-left text-sm">
                                {{ $log_entry->id }}
                            </td>
                            <td class="p-2 text-left text-sm">
                                <div class="flex w-full font-bold">
                                    {{ $log_entry->causer->name }}
                                </div>
                                <div class="flex w-full">
                                    {{ $log_entry->updated_at->diffForHumans() }}
                                </div>
                            </td>
                            <td class="p-2 align-middle">
                                @switch($log_entry->description)
                                    @case('created')
                                        <span class="inline-block p-1 text-xs font-bold rounded bg-green-100 text-green-800">
                                            <i class="fas fa-fw fa-plus-square"></i> Angelegt
                                        </span>
                                        @break
                                    @case('updated')
                                        <span class="inline-block p-1 text-xs font-bold rounded bg-yellow-100 text-yellow-800">
                                            <i class="fas fa-fw fa-edit"></i> Geändert
                                        </span>
                                        @break
                                    @case('deleted')
                                        <span class="inline-block p-1 text-xs font-bold rounded bg-red-100 text-red-800">
                                            <i class="fas fa-fw fa-trash"></i> Gelöscht
                                        </span>
                                        @break
                                @endswitch
                                <br>
                                <span class="inline-block p-1 mt-2 rounded bg-gray-100">
                                     {{ $log_entry->subject_type }} ID: <strong>{{ $log_entry->subject_id }}</strong>
                                </span>


                            </td>
                            <td class="p-2 text-left text-sm">
                                <ul>
                                    @foreach($log_entry->changes()->get('attributes') as $key => $value)
                                        <li>{{ $key ?? null }}: {{ $value ?? null }}</li>
                                    @endforeach
                                    @if($log_entry->description == 'updated')
                                        <li>Alt:</li>
                                        <ul class="ml-2">
                                        @foreach($log_entry->changes()->get('old') as $key => $value)
                                            <li>{{ $key ?? null }}: {{ is_array($value) ? implode($value) : $value }}</li>
                                        @endforeach
                                        </ul>
                                    @endif
                                <ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
