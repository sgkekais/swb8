@if($this->sortField !== $field)
    <i class="text-gray-500 fa fa-sort hover:text-blue-400"></i>
@elseif($this->sortAsc)
    <i class="text-blue-400 fa fa-sort"></i>
@else
    <i class="text-blue-400 fa fa-sort"></i>
@endif
