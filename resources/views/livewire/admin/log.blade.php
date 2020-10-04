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
                        <th class="p-2 text-center text-sm font-bold text-gray-500 uppercase tracking-wider">&nbsp;</th>
                        <th class="p-2 text-left text-sm font-bold text-gray-500 uppercase tracking-wider">Model</th>
                        <th class="p-2 text-left text-sm font-bold text-gray-500 uppercase tracking-wider">Model ID</th>
                        <th class="p-2 text-left text-sm font-bold text-gray-500 uppercase tracking-wider">Änderung</th>
                    </tr>
                </thead>                                              
                <tbody class="divide-y divide-gray-200">
                    @foreach ($log_entries as $log_entry)
                        <tr class="{{ $loop->even ? "bg-gray-50" : null}} hover:bg-gray-100">
                            <td class="p-2 text-left text-sm">{{ $log_entry->id }}</td>    
                            <td class="p-2 text-left text-sm">{{ $log_entry->causer->name }}</td>    
                            <td class="p-2 text-center text-sm">
                                @switch($log_entry->description)
                                    @case('created')
                                        <span class="inline-block p-1 text-xs font-bold rounded bg-green-100 text-green-800">Angelegt</span>
                                        @break
                                    @case('updated')
                                        <span class="inline-block p-1 text-xs font-bold rounded bg-yellow-100 text-yellow-800">Geändert</span>
                                        @break                                    
                                    @case('deleted')
                                        <span class="inline-block p-1 text-xs font-bold rounded bg-red-100 text-red-800">Gelöscht</span>
                                        @break
                                @endswitch
                            </td>    
                            <td class="p-2 text-left text-sm">{{ $log_entry->subject_type }}</td>
                            <td class="p-2 text-left text-sm">{{ $log_entry->subject_id }}</td>                            
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
